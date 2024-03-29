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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <!-- Styles -->
        <link rel="icon" href="{{ URL::asset('/imgs/king.png') }}" type="image/x-icon"/>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <style> html { background-color: #fff; color: #636b6f; font-family: 'Nunito', sans-serif; font-weight: 200; height: 100vh; margin: 0; }</style>
        <script>
            $(function() {

                // Toggle episode downloaded
                $('.toggle-downloaded').change(function() {
                    var status = $(this).prop('checked') == true ? 1 : 0;
                    var episodeid = $(this).attr('data-episodeid');

                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: "episode/" + episodeid + "/toggleDl",
                        data: { 'status': status },
                        success: function(data) {
                            console.log(data);
                        }
                    });
                });

            });
        </script>
        @if(session('success-add'))
        <script>
            $(function() {
                $('.confirmation-messages h3').html('Episode added successfully!');
                $('.confirmation-messages').addClass('show');
                setTimeout(function () {
                    $('.confirmation-messages').removeClass('show');
                }, 3000);
            });
        </script>
        @endif
        @if(session('success-update'))
        <script>
            $(function() {
                $('.confirmation-messages h3').html('Episode updated successfully!');
                $('.confirmation-messages').addClass('show');
                setTimeout(function () {
                    $('.confirmation-messages').removeClass('show');
                }, 3000);
            });
        </script>
        @endif
    </head>
    <body class="home">
        <audio id="checkitout">
            <source src="{{ URL::asset('/audio/dave-checkitout.mp3') }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
        <div class="flex-center position-ref">
            <button class="btn dark-mode-toggle">Dark Mode</button>
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
                <div class="title m-b-md">{{ env('APP_NAME') }}@if (env('APP_ENV') == 'local')<span class="subtitle"> DEV</span>@endif</div>
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
                                        <tr>
                                            @auth<th style="width:20px;"></th>@endauth
                                            <th>Episode #</th>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th style="width:20px;"></th>
                                            @auth<th style="width:20px;"></th>@endauth
                                        </tr>
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
                                            @auth<td><input class="toggle-downloaded" data-episodeid="{{ $episode->id }}" type="checkbox" @if($episode->downloaded) checked @endif></td>@endauth
                                            <td>{{ $episode->episode_number }}</td>
                                            <td data-toggle="hover" data-content="{{ $episode->description }}" data-placement="right">{{ $episode->title }}</td>
                                            <td class="date">{{ $episode->published_date }}</td>
                                            <td><a href="{{ $episode->link }}" target="new" class="btn btn-dark btn-sm listen">Listen</a></td>
                                            @auth<td><a href="/episode/{{ $episode->id }}/edit" class="btn btn-primary btn-sm edit"><i class="fa fa-pencil-square-o"></i></a></td>@endauth
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
        <div class="confirmation-messages"><img src="{{ URL::asset('/imgs/king.png') }}"><h3></h3></div>
    </body>
</html>
