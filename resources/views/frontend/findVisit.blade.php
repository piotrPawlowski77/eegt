@extends('layouts.frontend')
{{--ten widok jest przypisany do layoutu frontend--}}

@section('content')

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-lg-3">

                <h1 class="my-4">Zapisz na badanie</h1>
                <div class="list-group">
                    <a href="#" class="list-group-item">Category 1</a>
                    <a href="#" class="list-group-item">Category 2</a>
                    <a href="#" class="list-group-item">Category 3</a>
                </div>

            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9 my-5">

                <form method="post" action="{{ route('findVisitResult') }}">
                    <div class="input-group">
                        <input type="number" name="research_code" class="form-control" placeholder="Wpisz numer wizyty">
                        <div class="input-group-btn">
                            <button class="btn btn-success" type="submit">
                                <i class=" fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                    @csrf
                </form>

                <div>
                    @if( isset($visitDetails) && $visitDetails != false )



                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
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
                                    <tr>
                                        <th scope="row">{{ $visitDetails->id }}</th>
                                        <td>{{ $visitDetails->user->name }}</td>
                                        <td>{{ $visitDetails->user->surname }}</td>
                                        <td>{{ $visitDetails->user->nr_indeksu }}</td>
                                        <td>{{ $visitDetails->research->research_name }}</td>
                                        <td>{{ $visitDetails->research->description }}</td>
                                        <td>{{ $visitDetails->research->research_date }}</td>

                                        @foreach($visitDetails->research_hours as $research_hour)

                                            @if($research_hour->user_id == $visitDetails->user->id && $visitDetails->research_code == $research_hour->research_code)
                                                <td>{{ $research_hour->hour }}</td>
                                            @endif

                                        @endforeach


                                    </tr>

                                </tbody>
                            </table>

                    @else

                    @endif
                </div>

            </div>
            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

@endsection
