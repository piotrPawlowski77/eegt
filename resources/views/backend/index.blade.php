@extends('layouts.backend')
{{--ten widok jest przypisany do layoutu backend--}}

@section('content')

    <div class="col-lg-9 my-5">

        <h1>Lista wizyt</h1>

{{--        {{ dd($visits) }}--}}

        @if( isset($visits) && count($visits) != 0 )
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Id wizyty</th>
                    <th scope="col">Imię</th>
                    <th scope="col">Nazwisko</th>
                    <th scope="col">Numer indeksu</th>
                    <th scope="col">Nazwa badania</th>
                    <th scope="col">Opis badania</th>
                    <th scope="col">Data badania</th>
                    <th scope="col">Godzina badania</th>
                </tr>
                </thead>

                <tbody>

                @foreach($visits as $visit)
                    <tr>
                        <th scope="row">{{ $visit->id }}</th>
                        <td>{{ $visit->user->name }}</td>
                        <td>{{ $visit->user->surname }}</td>
                        <td>{{ $visit->user->nr_indeksu }}</td>
                        <td>{{ $visit->research->research_name }}</td>
                        <td>{{ $visit->research->description }}</td>
                        <td>{{ $visit->research->research_date }}</td>

                        @foreach($visit->research_hours as $research_hour)

                            @if($research_hour->user_id == $visit->user->id && $visit->research_code == $research_hour->research_code)
                                <td>{{ $research_hour->hour }}</td>
{{--                            @elseif($research_hour->user_id == 0)--}}
{{--                                <td>Wolny termin</td>--}}
{{--                            @else--}}
{{--                                <td>Wolny termin</td>--}}
                            @endif

                        @endforeach
                    </tr>
                @endforeach

                </tbody>
            </table>
        @else
            <div class="alert alert-info" role="alert">
                Brak wizyt w bazie!
            </div>
        @endif

    </div>
    <!-- /.col-lg-9 -->

@endsection
