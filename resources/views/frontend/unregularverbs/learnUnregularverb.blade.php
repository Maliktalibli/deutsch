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
                                    <th scope="col">Präsens</th>
                                    <th scope="col">Präteritum</th>
                                    <th scope="col">Perfekt</th>
                                    <th scope="col">Übersetzung</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($unregularVerbs as $unregularVerb)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$unregularVerb['word']}}</td>
                                    <td>{{$unregularVerb['prateritum']}}</td>
                                    <td>{{$unregularVerb['perfect']}}</td>
                                    <td>{{$unregularVerb['translate']}}</td>
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