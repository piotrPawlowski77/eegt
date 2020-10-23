@extends('layouts.backend')
{{--ten widok jest przypisany do layoutu backend--}}

@section('content')
    <div class="col-lg-9 my-5">

        <h1>Edycja badania {{ $research->research_name }}</h1>

        <form action="{{ route('updateResearch', $research) }}">

            <input name="_method" type="hidden" value="PUT">

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

                    <tr>
                        <td> <input type="text" name="research_id" value="{{ $research->research_id }}"> </td>
                        <td> <input type="text" name="research_name" value="{{ $research->research_name }}"> </td>
                        <td> <input type="text" name="description" value="{{ $research->description }}"> </td>
                        <td> <input type="text" name="research_date" value="{{ $research->research_date }}"> </td>
                        <td> <input type="text" name="availability" value="{{ $research->availability }}"> </td>

                    </tr>

                </tbody>
            </table>

            <div class="box-footer">
                <button type="submit" class="btn btn-success">Zapisz</button>
            </div>

            @csrf
        </form>

    </div>
    <!-- /.col-lg-9 -->
@endsection
