@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-9">
                <h1>Edit Category</h1>

                <form method="POST" action="{{ route('categories.update', ['id' => $category->id]) }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name"
                               class="form-control @error('name') is-invalid @enderror" value="{{ $category->name }}">
                        @error('name')
                        <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" value="EDIT" class="btn btn-primary col-12 mt-2">
                        </div>
                    </div>
                </form>
                <div class="row">
                <div class="col">
                    <form method="POST" action="{{ route('categories.destroy', ['id' => $category->id]) }}">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Delete" class="btn btn-danger col-12 mt-2">
                    </form>
                </div>
                </div>
            </div>
        </div>

    </div>
@endsection
