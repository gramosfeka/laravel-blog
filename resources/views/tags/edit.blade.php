@extends('layouts.app')

@section('content')
    <div class="container">
<div class="row">
    <div class="col-md-5 col-md-offset-9">
        <h1>Edit Tag</h1>

        <form method="POST" action="{{route('tags.update', ['id' => $tag->id])}}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ $tag->name }}">
                @error('name')
                <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                @enderror
            </div>
            <input type="submit" value="EDIT" class="btn btn-primary col-12 mt-2">

        </form>
            <form method="POST" action="{{ route('tags.destroy', ['id'=> $tag->id]) }}">
                @method('DELETE')
                @csrf
                <input type="submit" value="Delete" class="btn btn-danger col-12  mt-2 ">
            </form>
    </div>
</div>
    </div>
@endsection
