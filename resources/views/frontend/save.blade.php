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

                @if( isset($visit->research_code) )
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Wizyta zapisana pomyślnie!</h4>
                        <p>Twój numer wizyty to: {{ $visit->research_code }}</p>
                        <hr>
                        <p class="mb-0">Aby wyświetlić szczegóły wizyty <a href="{{ route('findVisit') }}" class="alert-link">przejdź tutaj</a> lub <a href="{{ route('home') }}" class="alert-link">wróć na stronę główną</a></p>

                    </div>

                @endif

                    @if( session()->has('message') )
                        <div class="alert alert-danger">
                            {{ session()->get('message') }}
                        </div>
                    @endif


            </div>
            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

@endsection
