<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/shop-homepage.css') }}" rel="stylesheet">

</head>
<body>

    @auth
        <form method="post" action="{{ route('save') }}">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">Imię</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Imię" value="{{ \Illuminate\Support\Facades\Auth::user()->name }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="surname">Nazwisko</label>
                    <input type="text" class="form-control" id="surname" name="surname" placeholder="Nazwisko" value="{{ \Illuminate\Support\Facades\Auth::user()->surname }}">
                </div>
            </div>
            <div class="form-group">
                <label for="nr_indeksu">Numer indeksu</label>
                <input type="number" class="form-control" id="nr_indeksu" placeholder="Numer indeksu" value="{{ \Illuminate\Support\Facades\Auth::user()->nr_indeksu }}">
            </div>

            <div class="form-row">
                <label for="research_name_id"> Nazwa badania </label>
                <select id="research_name_id" name="research_name" class="research_name">

                    <option value="0" disabled="true" selected="true">Nazwa badania</option>
                    @foreach($research_list as $research)
                        <option value="{{ $research->research_name }}">{{ $research->research_name }}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="description_id">Opis badania</label>

                <select id="description_id" name="description" class="description">

                    <option value="0" disabled="true" selected="true">Opis badania</option>


                </select>

            </div>

            <div class="form-group">
                <label for="research_date_id">Data badania</label>

                <select id="research_date_id" name="research_date" class="research_date">

                    <option value="0" disabled="true" selected="true">Data badania</option>


                </select>

            </div>

            <div class="form-row">
                <label for="hours_id"> Wybierz godzinę wizyty </label>
                <select id="hours_id" name="hours" class="hours">

                    <option value="0" disabled="true" selected="true">Wybierz godzinę wizyty</option>

                </select>
            </div>

            <button type="submit" class="btn btn-primary">Zapisz</button>
            @csrf
        </form>
    @endauth

    @guest
        <div class="alert alert-primary" role="alert">
            Aby zapisać się na badanie <a href="{{ route('login') }}" class="alert-link">zaloguj się</a> lub <a href="{{ route('register') }}" class="alert-link">zarejestruj darmowe konto</a>
        </div>
    @endguest



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            $(document).on('change','.research_name',function () {
                //console.log('Dzialaaaaaa');

                var research_name=$(this).val();
                //console.log(research_name);

                var div=$(this).parent().parent();

                var description_option=" ";

                $.ajax({
                   type: 'get',
                    url: '{!! \Illuminate\Support\Facades\URL::to('findResearchDescription') !!}',
                    data: {'research_name': research_name},
                    success:function (data) {
                        console.log('success!');
                        console.log('data: '+data);
                        console.log('data length: '+data.length);

                        description_option+='<option value="0" selected disabled>Opis badania</option>';
                        for(var i=0; i<data.length; i++)
                        {
                            description_option+='<option value="'+data[i].description+'">'+data[i].description+'</option>';
                        }

                        console.log(description_option);

                        console.log(div);

                        div.find('.description').html(" ");
                        div.find('.description').append(description_option);

                    },
                    error:function () {

                    }
                });

            });

            $(document).on('change','.description',function (){

                //console.log('Dzialaaaaaa');

                var description_name=$(this).val();
                //console.log(description_name);

                var div=$(this).parent().parent();

                var research_date_option=" ";

                $.ajax({
                    type: 'get',
                    url: '{!! \Illuminate\Support\Facades\URL::to('findResearchDate') !!}',
                    data: {'description_name': description_name},
                    success:function (data) {
                        console.log('success!');
                        console.log('data: '+data);
                        console.log('data length: '+data.length);

                        research_date_option+='<option value="0" selected disabled>Data badania</option>';
                        for(var i=0; i<data.length; i++)
                        {
                            research_date_option+='<option value="'+data[i].research_date+'">'+data[i].research_date+'</option>';
                        }

                        console.log(research_date_option);

                        console.log(div);

                        div.find('.research_date').html(" ");
                        div.find('.research_date').append(research_date_option);

                    },
                    error:function () {

                    }
                });

            });

            $(document).on('change','.research_date',function (){

                //console.log('Dzialaaaaaa');

                var research_date=$(this).val();
                //console.log(research_date);

                var div=$(this).parent().parent();

                var research_hours_option=" ";

                $.ajax({
                    type: 'get',
                    url: '{!! \Illuminate\Support\Facades\URL::to('findResearchHours') !!}',
                    data: {'research_date': research_date},
                    success:function (data) {
                        console.log('success!');
                        console.log('data: '+data);
                        console.log('data length: '+data.length);

                        research_hours_option+='<option value="0" selected disabled>Wybierz godzinę wizyty</option>';
                        for(var i=0; i<data.length; i++)
                        {
                            research_hours_option+='<option value="'+data[i].hour+'">'+data[i].hour+'</option>';
                        }

                        console.log(research_hours_option);

                        console.log(div);

                        div.find('.hours').html(" ");
                        div.find('.hours').append(research_hours_option);

                    },
                    error:function () {

                    }
                });

            });

        });
    </script>

</body>
</html>

