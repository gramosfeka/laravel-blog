@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="card">
                    <div class="card-header">
                        <h3>Update New Article</h3>
                    </div>
                    <div class="card-body">

                        <form method="POST" enctype="multipart/form-data" action="{{ route('articles.update', ['id'=>$article->id]) }}">
                            @method('PUT')
                            @csrf


                            <div class="form-group mt-2">
                                <label for="title">Title:</label>
                                <input class="form-control  @error('name') is-invalid @enderror"
                                       type="text" id="title" name="title"
                                       value="{{ $article->title }}">
                                @error('name')
                                <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                                @enderror
                            </div>

                            <div class="form-group mt-2">
                                <label for="category_id">Category:</label>
                                <select class="form-control @error('category_id') is-invalid @enderror"
                                        name="category_id" id="category_id">
                                    @foreach($categories as $category)
                                        @if($category->id == $article->category_id)
                                            <option selected="selected" value="{{ $category->id }}">{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach

                                </select>
                                @error('category_id')
                                <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                                @enderror
                            </div>

                            <div class="form-group mt-2">
                                <label for="tags">Tags:</label>
                                <select multiple="multiple"
                                        class="form-control multiple @error('tags') is-invalid @enderror"
                                        name="tags[]" id="tags">
                                    @foreach($tags as $tag)
                                        @if(in_array($tag->id , $tags_ids ))
                                            <option selected="selected" value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @else
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('tags')
                                <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                                @enderror
                            </div>

                            <div class="form-group mt-2">
                                <label for="image">Image:</label>
                                <input name="image" type="file"
                                       class="form-control @error('image') is-invalid @enderror"
                                       id="image">
                                <input type="hidden" name="image_old" value="{{$article->image}}">
                                @error('image')
                                <span class="invalid-feedback">
                                     {{ $message }}
                                 </span>
                                @enderror
                            </div>

                            <div class="form-group mt-2">
                                <label for="body">Description:</label>
                                <textarea
                                    class="form-control @error('body') is-invalid @enderror"
                                    name="body" id="editor"
                                    rows="10">{{ $article->body }}</textarea>
                                @error('body')
                                <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="created_at">Date:</label>
                                <input name="created_at" type="date"
                                       class="form-control @error('created_at') is-invalid @enderror"
                                       value="{{ $article->created_at }}" id="created_at">
                                @error('created_at')
                                <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <input type="submit" value="Submit" class="btn btn-success btn-lg mt-2 btn-block">
                            </div>
                        </form>
                        <div class="form-group mt-2">
                            <form method="POST" action="{{ route('articles.destroy', ['id'=>$article->id]) }}">
                                @method('DELETE')
                                @csrf
                                <input type="submit" value="Delete" class="btn btn-danger col-12 mt-2">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script>
        ClassicEditor
            .create(function (config)
                {
                    config.enterMode = CKEDITOR.ENTER_BR;
                },
                document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
