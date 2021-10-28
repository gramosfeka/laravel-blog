@extends('layouts.app')

@section('content')
    <div class="container">
<div class="row">
    <div class="col-md-4">
        <div>

            <h2>New Tag</h2>
            <form method="POST" action="{{ route('tags.store') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="">
                    @error('name')
                    <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                    @enderror
                </div>
                <div class="col">
                    <input type="submit" value="Create new Tag" class="btn btn-primary col-12 mt-2">
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6 offset-md-2">

        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Edit</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tags as $tag)
            <tr>
                <th scope="row">{{$tag->id}}</th>
                <td>{{$tag->name}}</td>
                <td><a href="{{ route('tags.edit', ['id'=>$tag->id]) }}"
                       class="btn btn-light btn-sm m-1">Edit</a></td>

            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>

    </div>
@endsection






