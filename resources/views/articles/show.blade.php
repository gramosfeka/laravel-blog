@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">

            <img src="{{asset('images/'. $article->image) }} "
                 style="width: 450px;height: 400px;">
            <h1>{{ $article->title }}</h1>
            <p class="lead">{!! $article->body !!} </p>
            <hr>
            <p>Category: {{ $article->category->name }}</p>

            <p>Published date: {{ date("d-m-Y", strtotime( $article->created_at)) }}</p>

            <p class="mb-4"> Tags:
                @foreach($article->tags as $tag)
                <button type="button" class="btn btn-secondary  btn-sm ">
                    {{$tag->name}}
                </button>
                @endforeach

            </p>
        </div>

    </div>
</div>


@endsection
