<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kapitel;
use App\Models\Teil;
use App\Models\Goethe;

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
            session()->push('fail_word', $correct_word['word']);
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

    public function goethe()
    {
        return view('frontend.goethe.index');
    }

    public function goetheLevel($level)
    {
        $pages = Goethe::where('level', $level)->distinct()->get(['page','section']);

        return view('frontend.goethe.words', compact('level', 'pages'));
    }

    public function learnGoethe($level, $teil, $page = 'all')
    {
        if($page == 'all') {
            $words = Goethe::where([['level', $level],['section', $teil]])->get();
        }else{
            $words = Goethe::where([['level', $level],['section', $teil], ['page', $page]])->get();
        }

        
        
        return view('frontend.goethe.learnGoethe', compact('level', 'words'));
    }

    public function testGoethe($level, $teil, $page = 'all')
    {
        if($page == 'all') {
            $words = Goethe::where([['level', $level],['section', $teil]])->get('id');
        }else{
            $words = Goethe::where([['level', $level],['section', $teil], ['page', $page]])->get('id');
        }
        
        session()->forget('word');
        session()->forget('fail_word');
        
        foreach ($words as $word) {
            $value = $word['id'];
            session()->push('word', $value);
        }

        $word_array = session()->get('word');
        $rand_word_key = array_rand($word_array);
        $rand_word_id = $word_array[$rand_word_key];
        $rand_word = Goethe::findOrFail($rand_word_id);

        return view('frontend.goethe.testGoethe', compact('level', 'teil', 'page', 'rand_word'));

    }

    public function testGoethePost(Request $request, string $level, $teil, $page)
    {


        $rand_answer = strtolower($request->answer);
        $rand_word_id = $request->word_id;


        $correct_word = Goethe::where('id', $rand_word_id)->first();

        if (strtolower($correct_word['word']) == $rand_answer) {
            
            $session_words = session()->get('word');
            $new_session_words = array_values(array_diff($session_words, array($rand_word_id)));
            session()->forget('word');
            session(['word' => $new_session_words]);

            $check = [1, 'Doğrudur!<br>', '<strong>'.$correct_word['word'].':</strong> '.$correct_word['translate'], '<strong>Artikel:</strong> '.$correct_word['artikel'], '<strong>Plural:</strong> '.$correct_word['plural'], '<strong>Perfekt:</strong> '.$correct_word['perfekt'], $correct_word['sentence']];

        }else{
            
            $check = [0, $rand_answer.' yanlışdır!<br>', '<strong>'.$correct_word['word'].':</strong> '.$correct_word['translate']];
            session()->push('fail_word', $correct_word['word']);
        }
        
        if (isset($new_session_words) AND empty($new_session_words)) {
            $rand_word = FALSE;
        }else{
            $word_array = session()->get('word');
            $rand_word_key = array_rand($word_array);
            $rand_word_id = $word_array[$rand_word_key];
            $rand_word = Goethe::findOrFail($rand_word_id);
        }
        

        return view('frontend.goethe.testGoethe', compact('rand_word','level','check', 'teil', 'page'));

    }

    
}
