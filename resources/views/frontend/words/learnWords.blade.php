@extends('layouts')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"> UNREGELMÄSSIGE VERBEN {{$level}} </h1>

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Always responsive</h5>
                        <h6 class="card-subtitle text-muted"></h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Word</th>
                                    <th scope="col">Translate</th>
                                    <th scope="col">Note</th>
                                    <th scope="col">Page</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($words as $word)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$word['word']}}</td>
                                    <td>{{$word['translate']}}</td>
                                    <td>{{$word['note']}}</td>
                                    <td>{{$word['page']}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
			
@endsection