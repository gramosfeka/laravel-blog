@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-10">

                <h1>All Articles</h1>
            </div>
            <div class="col-md-2">
                <a href="{{ route('articles.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">Create
                    New
                    Article</a>
            </div>
            <div class="col-md-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Body</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="row_position">

                    @foreach($articles as $article)
                        <tr data-index="{{ $article->id }}" data-position="{{ $article->position }}">
                            <td>{{$article->id}}</td>
                            <td>{{ $article->title }}</td>

                            <td>{{ substr(strip_tags($article->body), 0, 50), strlen($article->body) > 50 ? "..." : ""  }} </td>


                            <td class="text-center">

                                @if(Auth::user()->role == 'admin' && $article->status == 0)
                                    <a
                                        href="{{ route('articles.approve', ['id'=> $article->id]) }}"
                                        class="btn btn-default btn-sm">Approve</a>

                                    <a href="{{ route('articles.edit', ['id'=> $article->id]) }}"
                                       target='_blank' class="edit btn btn-default btn-sm">Edit</a>
                                @else
                                    <a href="{{ route('articles.edit', ['id'=> $article->id]) }}"
                                       target='_blank' class="edit btn btn-default btn-sm">Edit</a>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>
        </div>


    </div>
@endsection
