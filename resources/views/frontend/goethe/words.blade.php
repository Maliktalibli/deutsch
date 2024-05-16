@extends('layouts')

@section('content')

<div class="container-fluid p-0">

    <div class="mb-3">
        <h1 class="h3 d-inline align-middle"> Kapitel</h1>
    </div>
    <div class="row">
        @for($i = 'A'; $i < 'Z'; $i++)
        <div class="col-12 col-md-3">
            <div class="card">
                <img class="card-img-top" src="/assets/img/photos/{{$i}}.jpg" alt="Unsplash">
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <div class="input-group mb-3">
                        <a href="{{route('front.testGoethe', [$level, $i, 'all'])}}" class="btn btn-primary" id="test{{$i}}">Go</a>
                        <select class="form-select flex-grow-1 pages" title="{{$i}}">
                            <option value="all">Select...</option>
                            @foreach($pages as $page)
                                @if($i == $page['section'])
                                <option value="{{$page['page']}}">{{$page['page']}}</option>
                                @endif
                            @endforeach
                        </select>
                        <a href="{{route('front.learnGoethe', [$level, $i, 'all'])}}" class="btn btn-primary" id="learn{{$i}}">Learn</a>
                    </div>
                    
                </div>
            </div>
        </div>
        @endfor
    </div>

</div>

@endsection
    
@section('js')


<script>

var pages = document.getElementById("pages");
var pagesClass = document.getElementsByClassName("pages");

for (var i = 0; i < pagesClass.length; i++) {
    // Her bir element için change olayını dinle
    pagesClass[i].addEventListener('change', function() {
        var page = this.value;
        var title = this.getAttribute("title");
        var test = document.getElementById("test"+title);
        var testHref = test.getAttribute("href");

        var learn = document.getElementById("learn"+title);
        var learnHref = learn.getAttribute("href");

        var newTestHref =  test.href = url(testHref) + '/' + page;
        var newlearnHref =  learn.href = url(learnHref) + '/' + page;
        

        console.log(newTestHref);
    });
}

function url(url)
{
    var currentURL = url;

    // URL'yi parçala
    var urlParts = currentURL.split('/');

    // Son segmenti kaldır
    urlParts.pop();

    // Yeni URL'yi oluştur
    var newURL = urlParts.join('/');

    // Yeni URL'yi görüntüle veya kullan
    return newURL;
}

</script>

@endsection

