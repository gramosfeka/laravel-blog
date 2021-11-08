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
<hr>
<div class="col-md-6 mx-auto">
    <div id="backend-comments" style="margin-top: 50px;">

        @if($article->comments->count() != 0)
        <h3>Comments <small>{{ $article->comments->count() }} total</small></h3>

        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Comment</th>
                <th width="70px"></th>
            </tr>
            </thead>
            <tbody>
                @foreach($article->comments as $comment)
                    <tr>
                        <td>{{$comment->user->name}}</td>
                        <td>{!! $comment->comment !!}</td>
                        <td>
                            @if($comment->user->id == Auth::user()->id)
                            <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-xs btn-primary">Edit<span
                                        class="glyphicon glyphicon-pencil"></span></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @else
            <h3>Comments <small>There are no comments avilable</small></h3>
        @endif
    </div>
</div>
<div class="row">
    <div id="comment-form" class="col-md-6 mx-auto" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('comments.store', ['post_id'=> $article->id]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea class="form-control" name="comment" id="comment"
                              rows="10"></textarea>
                    </div>
                    <input type="submit" value="Add Comment" class="btn btn-success btn-lg btn-block">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
    <script>
        ClassicEditor
            .create(document.querySelector('#comment'),{
                enterMode: ClassicEditor.ENTER_BR
            })
            .then(
                editor => {
                    console.log(editor);
                })

            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
