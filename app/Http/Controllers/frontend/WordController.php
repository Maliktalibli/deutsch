<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kapitel;
use App\Models\Teil;

class WordController extends Controller
{
    public function words()
    {
        return view('frontend.words.index');
    }

    public function wordsLevel($level)
    {
        $teils = Teil::all();
        $pages = Kapitel::where('level', $level)->distinct()->get(['page','section']);

        return view('frontend.words.kapitel', compact('level', 'teils', 'pages'));
    }

    public function learnWords($level, $teil, $page = 'all')
    {
        if($page == 'all') {
            $words = Kapitel::where([['level', $level],['section', $teil]])->get();
        }else{
            $words = Kapitel::where([['level', $level],['section', $teil], ['page', $page]])->get();
        }
        
        return view('frontend.words.learnWords', compact('level', 'words'));
    }

    public function testWords($level, $teil, $page = 'all')
    {
        if($page == 'all') {
            $words = Kapitel::where([['level', $level],['section', $teil]])->get('id');
        }else{
            $words = Kapitel::where([['level', $level],['section', $teil], ['page', $page]])->get('id');
        }

        session()->forget('word');
        
        foreach ($words as $word) {
            $value = $word['id'];
            session()->push('word', $value);
        }

        $word_array = session()->get('word');
        $rand_word_key = array_rand($word_array);
        $rand_word_id = $word_array[$rand_word_key];
        $rand_word = Kapitel::findOrFail($rand_word_id);

        return view('frontend.words.testWords', compact('level', 'teil', 'page', 'rand_word'));

    }

    public function testWordsPost(Request $request, string $level, $teil, $page)
    {


        $rand_answer = strtolower($request->answer);
        $rand_word_id = $request->word_id;


        $correct_word = Kapitel::where('id', $rand_word_id)->first();

        if (strtolower($correct_word['word']) == $rand_answer) {
            
            $session_words = session()->get('word');
            $new_session_words = array_values(array_diff($session_words, array($rand_word_id)));
            session()->forget('word');
            session(['word' => $new_session_words]);

            $check = [1, 'Doğrudur!<br>', '<strong>'.$correct_word['word'].':</strong> '.$correct_word['translate']];

        }else{
            
            $check = [0, $rand_answer.' yanlışdır!<br>', '<strong>'.$correct_word['word'].':</strong> '.$correct_word['translate']];
        }
        
        if (isset($new_session_words) AND empty($new_session_words)) {
            $rand_word = FALSE;
        }else{
            $word_array = session()->get('word');
            $rand_word_key = array_rand($word_array);
            $rand_word_id = $word_array[$rand_word_key];
            $rand_word = Kapitel::findOrFail($rand_word_id);
        }
        

        return view('frontend.words.testWords', compact('rand_word','level','check', 'teil', 'page'));

    }
}
