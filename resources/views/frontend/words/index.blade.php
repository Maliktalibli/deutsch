@extends('layouts')

@section('content')

<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Words</h1>
    </div>
    <div class="row">

        <div class="col-12 col-md-3">
            <div class="card">
                <img class="card-img-top" src="/assets/img/photos/a1.webp" alt="Unsplash">
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="{{route('front.wordsLevel', 'A1')}}" class="btn btn-success">Go</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card">
                <img class="card-img-top" src="/assets/img/photos/a2.webp" alt="Unsplash">
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="{{route('front.wordsLevel', 'A2')}}" class="btn btn-primary">Go</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card">
                <img class="card-img-top" src="/assets/img/photos/b1.png" alt="Unsplash">
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="{{route('front.wordsLevel', 'B1')}}" class="btn btn-success">Go</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card">
                <img class="card-img-top" src="/assets/img/photos/b2.png" alt="Unsplash">
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="{{route('front.wordsLevel', 'B2')}}" class="btn btn-primary">Go</a>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection