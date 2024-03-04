@extends('layouts')

@section('content')

@php
                                
    $allSession = session()->all();
    $verbSession = session()->only($keys);

    if (!empty($verbSession)) {
        $oneSessionKey = array_rand($verbSession);
        $oneSession = session($oneSessionKey, 'default');
    }else{
        $oneSessionKey = 'Sözlər bitdi!';
        $oneSession['id'] = null;
        $oneSession['translate'] = 'Sözlər bitdi!';
    }

    if (!isset($switch)) {
        $switch = 1;
    }
    
@endphp

<main class="content">
    <div class="container-fluid p-0">

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">UNREGELMÄSSIGE VERBEN {{$level}}</h1>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" {{ $switch ? 'checked=""' : '' }}>
                <label class="form-check-label" for="flexSwitchCheckChecked" id="labelText">With Präteritum</label>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card">
                    
                    <div class="card-header">
                        <div class="alert alert-primary alert-dismissible" role="alert">
                            <div class="alert-message">
                                <strong>{{$oneSessionKey}} - </strong> {{$oneSession['translate']}}
                            </div>
                        </div>
                    </div>

                    @if(isset($check[0]) && $check[0] == 1)
                    <div class="card-header check">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <div class="alert-message">
                                <p>{!! $check[1] !!}</p>
                                <p>{!! $check[2] !!}</p>
                            </div>
                        </div>
                    </div>
                    @elseif(isset($check[0]) && $check[0] == 0)
                    <div class="card-header check">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <div class="alert-message">
                                <p>{!! $check[1] !!}</p>
                                <p>{!! $check[2] !!}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <div class="card-body">
                        <form method="POST" action="{{route('front.unregularverbPost', $level)}}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Präteritum </label> <i class="fa-solid fa-eye prt"></i>
                                <input autocomplete="off" required type="text" class="form-control" placeholder="Insert Präteritum" name="prateritum" id="main_prt">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Perfekt </label> <i class="fa-solid fa-eye prf"></i>
                                <input autocomplete="off" required type="text" class="form-control" placeholder="Insert Perfekt" name="perfect" id="main_prf">
                            </div>
                            <input type="hidden" value="{{$oneSession['prateritum']}}" name="prt" id="hidden_prt">
                            <input type="hidden" value="{{$oneSession['perfect']}}" name="prf" id="hidden_prf">
                            <input type="hidden" value="{{$oneSession['id']}}" name="verb_id">
                            <input type="hidden" value="{{$oneSessionKey}}" name="verb">
                            <input type="hidden" value="1" name="switch" id="switchSend">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

@endsection

@section('js')
<script>

    // const myElement = document.querySelector('.check');
    // setTimeout(function() {
    //     myElement.style.display = 'none';
    // }, 60000);

    const prt = document.querySelector('.prt');
    const prf = document.querySelector('.prf');
    
    prt.addEventListener('click', function() {
        prt_hidden_Input = document.getElementById('hidden_prt').value;
        prt_main_Input = document.getElementById('main_prt').value = prt_hidden_Input;
    });
    
    prf.addEventListener('click', function() {
        prf_hidden_Input = document.getElementById('hidden_prf').value;
        prf_main_Input = document.getElementById('main_prf').value = prf_hidden_Input;
    });

    const switchKey = document.getElementById('flexSwitchCheckChecked');

    switchKey.addEventListener('click', function(){
        if (switchKey.checked) {
            const switchSend = document.getElementById('switchSend').value = 1;
            prt_main_Input = document.getElementById('main_prt').value = '';

            const labelText = document.getElementById('labelText').innerHTML = 'With Präteritum';

        } else {
            const switchSend = document.getElementById('switchSend').value = 0;
            prt_hidden_Input = document.getElementById('hidden_prt').value;
            prt_main_Input = document.getElementById('main_prt').value = prt_hidden_Input;

            const labelText = document.getElementById('labelText').innerHTML = 'Without Präteritum';

        }
    });

    if (switchKey.checked) {
        const labelText = document.getElementById('labelText').innerHTML = 'With Präteritum';

    } else {
        const labelText = document.getElementById('labelText').innerHTML = 'Without Präteritum';
        const switchSend = document.getElementById('switchSend').value = 0;
        prt_hidden_Input = document.getElementById('hidden_prt').value;
        prt_main_Input = document.getElementById('main_prt').value = prt_hidden_Input;

    }
</script>
@endsection