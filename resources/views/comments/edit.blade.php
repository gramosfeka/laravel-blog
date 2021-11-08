@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Edit Comment</h1>
            <form method="POST" action="{{route('comments.update',$comment->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea type="text" rows="10" cols="100" name="comment" id="comment">{{$comment->comment}}</textarea><br>
                </div>
                    <input type="submit" value="Edit" class="btn btn-lg btn-block btn-success my-2 ml-4">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form method="POST" action="{{route('comments.destroy',$comment->id)}}">
                @csrf
                @method('DELETE')
                <input type="submit" value="Delete" class="btn btn-lg btn-block btn-danger ml-4">
            </form>
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
