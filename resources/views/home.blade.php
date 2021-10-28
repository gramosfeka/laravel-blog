@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class='col-md-2'>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active">
                        <i class="fa fa-home"></i> Categories
                    </a>
                   @foreach($categories as $category)
                    <a href="{{ route('category', ['id'=> $category->id]) }}"
                       class="list-group-item list-group-item-action">
                        <i class="fa fa-home"></i>{{$category->name}}
                    </a>
                    @endforeach

                </div>
            </div>
            <div class="row col-md-10">

               @foreach($articles as $article)
                <div id="myTable" class='col-md-4' style="margin-bottom: 20px;">
                    <div class='panel panel-info'>

                        <div class='panel-body'>
                            <img src="{{asset('images/'. $article->image) }}"
                                 style="width: 250px;height: 300px; margin-bottom: 10px;">
                            <h4>{{ $article->title }}</h4>
                            <a href="{{ route('articles.show', ['id'=>$article->id]) }}"
                               class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>

@endsection
