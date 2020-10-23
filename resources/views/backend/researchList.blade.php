@extends('layouts.backend')
{{--ten widok jest przypisany do layoutu backend--}}

@section('content')
    <div class="col-lg-9 my-5">

        <h1>Lista badań</h1>

        @if( isset($researchList) && count($researchList) != 0 )

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Id badania</th>
                        <th>nazwa badania</th>
                        <th>opis</th>
                        <th>data badania</th>
                        <th>dostępność</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($researchList as $research)
                            <tr>
                                <td>{{$research->research_id}}</td>
                                <td>{{$research->research_name}}</td>
                                <td>{{$research->description}}</td>
                                <td>{{$research->research_date}}</td>
                                <td>{{$research->availability}}</td>


                                <td>
                                        <div>
                                            <a href="{{ route('editResearch', $research->research_id) }}" class="btn btn-success btn-xs" title="Edytuj">
                                                <i class="fa fa-pencil-square-o"></i> Edytuj
                                            </a>

                                            <a href="{{ route('deleteResearch', $research->research_id) }}" class="btn btn-danger btn-xs" onclick="return confirm('Jesteś pewien?')" title="Skasuj">
                                                <i class="fa fa-trash-o"></i> Usuń
                                            </a>
                                        </div>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>
                </table>

            <div class="footer-button">
                <a href="#" class="btn btn-secondary">Dodaj badanie</a>
            </div>
        @else
            <div class="alert alert-info" role="alert">
                Brak badań w bazie!
            </div>
        @endif




    </div>
    <!-- /.col-lg-9 -->
@endsection
