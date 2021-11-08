@extends('layouts.app')

@section('content')

    <div class="container">

    <div class="row">
    <div class="col-md-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h3>Add New Article</h3>
            </div>
            <div class="card-body">

                <form method="POST" enctype="multipart/form-data" action="{{ route('articles.store') }}">
                    @csrf


                    <div class="form-group mt-2">
                        <label for="title">Title:</label>
                        <input class="form-control  @error('name') is-invalid @enderror"
                               type="text" id="title" name="title"
                               value="">
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
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
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
                            rows="10"></textarea>
                        @error('body')
                        <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="created_at">Date:</label>
                        <input name="created_at" type="datetime-local"
                               class="form-control @error('created_at') is-invalid @enderror"
                               value="" id="created_at">
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
            </div>
        </div>
    </div>
</div>

</div>
@endsection
@section('js')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'),{
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
