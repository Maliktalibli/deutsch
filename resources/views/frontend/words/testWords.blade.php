@extends('layouts')

@section('content')


<main class="content">
    <div class="container-fluid p-0">

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">UNREGELMÄSSIGE VERBEN {{$level}}</h1>
        </div>

        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card">
                    @if($rand_word)
                    <div class="card-header">
                        <div class="alert alert-primary alert-dismissible" role="alert">
                            <div class="alert-message">
                                {{$rand_word['translate']}}
                            </div>
                        </div>
                    </div>
                    @endif
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
                    @if($rand_word)
                    <div class="card-body">
                        <form method="POST" action="{{route('front.testWordsPost', [$level, $teil, $page])}}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Word </label> <i class="fa-solid fa-eye prf"></i>
                                <input autocomplete="off" required type="text" class="form-control" placeholder="Insert Word" name="answer" id="main_prf">
                            </div>
                            <input type="hidden" value="{{$rand_word['word']}}" name="word" id="hidden_prf">
                            <input type="hidden" value="{{$rand_word['id']}}" name="word_id">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    @else
                    <div class="card-header">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <div class="alert-message">
                                <p>Sözlər bitdi!</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</main>

@endsection

@section('js')
<script>


    const prf = document.querySelector('.prf');
    
    prf.addEventListener('click', function() {
        prf_hidden_Input = document.getElementById('hidden_prf').value;
        prf_main_Input = document.getElementById('main_prf').value = prf_hidden_Input;
    });


</script>
@endsection