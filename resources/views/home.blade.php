<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'King\'s Speech Archive') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .year-filter,
            .type-filter {
                display: flex;
                margin-bottom: .5rem;
            }

            .year-filter .btn,
            .type-filter .btn {
                flex-grow: 1;
                margin: auto 5px;
                font-weight: 700;
            }

            .year-filter .btn:first-of-type,
            .type-filter .btn:first-of-type {
                margin-left: 0;
            }

            .year-filter .btn:last-of-type,
            .type-filter .btn:last-of-type {
                margin-right: 0;
            }

            .type-filter .btn.jazz-fight {
                background-color: #ffddde;
            }

            .type-filter .btn.diamond-collection {
                background-color: #b4dcff;
            }

            .search {
                margin-bottom: 1rem;
            }

            .reset {
                display: none;
                width: 30px; 
                height: 30px; 
                padding: 2px 0px; 
                border-radius: 15px; 
                font-size: 15px; 
                text-align: center;
                position: absolute;
                top: 49px;
                left: -25px;
            }

            .table tbody tr {
                transition: all 0.2s ease;
            }

            .table tbody tr.diamond-collection {
                background-color: #b4dcff;
            }

            .table tbody tr.jazz-fight {
                background-color: #ffddde;
            }

            .table tbody tr td {
                font-weight: 700;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/add') }}">Add Episode</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">{{ env('APP_NAME') }}</div>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="topbox">
                                <div class="year-filter">
                                    <button type="button" class="btn btn-warning" data-year="2020">2020</button>
                                    <button type="button" class="btn btn-warning" data-year="2019">2019</button>
                                    <button type="button" class="btn btn-warning" data-year="2018">2018</button>
                                    <button type="button" class="btn btn-warning" data-year="2017">2017</button>
                                    <button type="button" class="btn btn-warning" data-year="2016">2016</button>
                                    <button type="button" class="btn btn-warning" data-year="2015">2015</button>
                                </div>
                                <div class="type-filter">
                                    <button type="button" class="btn jazz-fight" data-type="jazz-fight">Jazz Fight</button>
                                    <button type="button" class="btn diamond-collection" data-type="diamond-collection">Diamond Collection</button>
                                </div>
                                <div class="search">
                                    <input class="form-control" type="text" placeholder="Search" id="tableSearch">
                                </div>
                                <div class="btn btn-secondary reset"><i class="fa fa-remove"></i></div>
                            </div>
                            @if(count($episodes))
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr><th>Episode #</th><th>Title</th><th>Date</th><th style="width:20px;"></th></tr>
                                    </thead>
                                    <tbody>
                                    @foreach($episodes as $episode)
                                        @if ($episode->diamond_collection)
                                        <tr class="diamond-collection">
                                        @elseif ($episode->jazz_fight)
                                        <tr class="jazz-fight">
                                        @else
                                        <tr>
                                        @endif
                                            <td>{{ $episode->episode_number }}</td>
                                            <td data-toggle="hover" data-content="{{ $episode->description }}" data-placement="right">{{ $episode->title }}</td>
                                            <td class="date">{{ $episode->published_date }}</td>
                                            <td><a href="{{ $episode->link }}" target="new" class="btn btn-dark btn-sm">Listen</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <hr />
                                <p><strong>No episodes :(</strong></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
