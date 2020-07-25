@if (!Auth::check())
    <script>window.location = "/";</script>
@endif

@extends('layouts.app')
@section('title') Edit Episode | @endsection

@section('content')
<div class="container admin">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Episode</div>
                <div class="card-body form-card">
                    <form method="POST" action="/episode/{{ $episode->id }}/update">
                        @csrf

                        <div class="field">
                            <label class="label" for="episode-number">Episode Number*</label>
                            <div class="control">
                                <input class="input form-control @error('episode-number') is-danger @enderror" type="text" name="episode-number" id="episode-number" value="{{ $episode->episode_number }}">
                                @error('episode-number')
                                    <p class="help is-danger">{{ $errors->first('episode-number') }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="field">
                            <label class="label" for="title">Title:</label>
                            <div class="control">
                                <input class="input form-control @error('title') is-danger @enderror" type="text" name="title" id="title" value="{{ $episode->title }}">
                                @error('title')
                                    <p class="help is-danger">{{ $errors->first('title') }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="field">
                            <label class="label" for="link">Link:</label>
                            <div class="control">
                                <input class="input form-control @error('link') is-danger @enderror" type="text" name="link" id="link" value="{{ $episode->link }}">
                                @error('link')
                                    <p class="help is-danger">{{ $errors->first('link') }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="field">
                            <label class="label" for="jazz-fight">Jazz Fight:</label>
                            <div class="control">
                                <input class="input" type="checkbox" {{ $episode->jazz_fight ? 'checked': '' }} name="jazz-fight" id="jazz-fight">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label" for="diamond-collection">Diamond Collection:</label>
                            <div class="control">
                                <input class="input" type="checkbox" {{ $episode->diamond_collection ? 'checked': '' }} name="diamond-collection" id="diamond-collection">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label" for="published-date">Published Date:</label>
                            <div class="control">
                                <input class="input form-control" type="date" name="published-date" id="published-date" value="{{ $episode->published_date }}">
                                @if ($errors->has('published-date'))
                                    <p class="error-msg">{{ $errors->first('published-date') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="field">
                            <label class="label" for="description">Description:</label>
                            <div class="control">
                                <textarea class="textarea form-control" name="description" id="description">{{ $episode->description }}</textarea>
                                @if ($errors->has('description'))
                                    <p class="error-msg">{{ $errors->first('description') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="field btns">
                            <button class="btn btn-lg submit" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection