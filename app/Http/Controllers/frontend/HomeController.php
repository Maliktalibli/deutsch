<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UnregularVerb;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function unregularVerb(string $level)
    {
        $unregularVerbs = Unregularverb::where('level', $level)->get();
        
        foreach ($unregularVerbs as $unregularVerb) {
            $key = $unregularVerb['word'];
            $keys[] = $key;
            $value = json_decode(json_encode($unregularVerb), true);
            session([$key => $value]);
        }

        // $allSession = session()->all();
        // $verbSession = session()->only($keys);
        // $oneSessionKey = array_rand($verbSession);
        // $oneSession = session($oneSessionKey, 'default');


        return view('frontend.unregularverbs.unregularverb', compact('keys','level'));

    }

    public function unregularVerbPost(Request $request, string $level)
    {

        $prateritum = strtolower($request->prateritum);
        $perfect = strtolower($request->perfect);
        $verb_id = $request->verb_id;
        $verb = $request->verb;
        $switch = $request->switch;

        $unregularVerb = Unregularverb::where('id', $verb_id)->first();
        $unregularVerbs = Unregularverb::where('level', $level)->get();

        foreach ($unregularVerbs as $uVerb) {
            $key = $uVerb['word'];
            $keys[] = $key;
        }

        if ($unregularVerb['prateritum'] == $prateritum && $unregularVerb['perfect'] == $perfect) {
            session()->forget($verb);
            $check = [1, '<strong>'.$unregularVerb['word'].':</strong> Hər ikisi doğrudur!', '<strong>Präteritum:</strong> '.$unregularVerb['prateritum'].'<br> <strong>Perfekt:</strong> '.$unregularVerb['perfect']];

        }elseif($unregularVerb['prateritum'] != $prateritum && $unregularVerb['perfect'] == $perfect){
            $check = [0, '<strong>'.$unregularVerb['word'].':</strong> Präteritum yanlış, Perfekt doğrudur!', '<strong>Präteritum:</strong> '.$unregularVerb['prateritum'].'<br> <strong>Perfekt:</strong> '.$unregularVerb['perfect']];

        }elseif($unregularVerb['prateritum'] == $prateritum && $unregularVerb['perfect'] != $perfect){
            $check = [0, '<strong>'.$unregularVerb['word'].':</strong> Präteritum doğru, Perfekt yanlışdır!', '<strong>Präteritum:</strong> '.$unregularVerb['prateritum'].'<br> <strong>Perfekt:</strong> '.$unregularVerb['perfect']];

        }else{
            $check = [0, '<strong>'.$unregularVerb['word'].':</strong> Həm Präteritum, həm də Perfekt yanlışdır!', '<strong>Präteritum:</strong> '.$unregularVerb['prateritum'].'<br> <strong>Perfekt:</strong> '.$unregularVerb['perfect']];
        }
        
        

        return view('frontend.unregularverbs.unregularverb', compact('keys','level','check', 'switch'));

    }
    
    public function learnUnregularVerb(string $level)
    {
        $unregularVerbs = Unregularverb::where('level', $level)->get();
        
        return view('frontend.unregularverbs.learnUnregularverb', compact('unregularVerbs', 'level'));
    }



}
