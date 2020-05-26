@if (!Auth::check())
    <script>window.location = "/";</script>
@endif

@extends('layouts.app')
@section('title') Add Episode | @endsection

@section('content')
<div class="container admin">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Episode</div>
                <div class="card-body form-card">
                    <form method="POST" action="/add">
                        @csrf

                        <div class="field">
                            <label class="label" for="episode-number">Episode Number:</label>
                            <div class="control">
                                <input class="input form-control" type="text" name="episode-number" id="episode-number">
                                @if ($errors->has('episode-number'))
                                    <p class="error-msg">{{ $errors->first('episode-number') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="field">
                            <label class="label" for="title">Title:</label>
                            <div class="control">
                                <input class="input form-control" type="text" name="title" id="title">
                                @if ($errors->has('title'))
                                    <p class="error-msg">{{ $errors->first('title') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="field">
                            <label class="label" for="link">Link:</label>
                            <div class="control">
                                <input class="input form-control" type="text" name="link" id="link">
                                @if ($errors->has('link'))
                                    <p class="error-msg">{{ $errors->first('link') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="field">
                            <label class="label" for="jazz-fight">Jazz Fight:</label>
                            <div class="control">
                                <input class="input" type="checkbox" name="jazz-fight" id="jazz-fight">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label" for="diamond-collection">Diamond Collection:</label>
                            <div class="control">
                                <input class="input" type="checkbox" name="diamond-collection" id="diamond-collection">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label" for="published-date">Published Date:</label>
                            <div class="control">
                                <input class="input form-control" type="date" name="published-date" id="published-date">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label" for="description">Description:</label>
                            <div class="control">
                                <textarea class="textarea form-control" name="description" id="description"></textarea>
                            </div>
                        </div>
                        <div class="field btns">
                            <button class="btn btn-lg submit" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection