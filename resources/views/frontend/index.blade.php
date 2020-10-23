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
                    @auth
                        @if(Auth::user()->hasRole(['patient']))
                            <a href="{{ route('findVisit') }}" class="list-group-item">Wyszukaj wizytę</a>
                        @endif
                    @endauth
                </div>

            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9 my-5">

                @include("frontend.dynamic_form")

            </div>
            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
@endsection
