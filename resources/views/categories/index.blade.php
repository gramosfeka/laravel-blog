@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-4">
                <div >
                    <h2>New Category</h2>
                    <form method="POST" action="{{ route('categories.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                        <div class="col">
                            <input type="submit" value="Create new Category" class="btn btn-primary col-12 mt-2">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <table class="table">
                    <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Edit</th>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <th scope="row">{{ $category->id }}</th>
                            <td>{{ $category->name }}</td>
                            <td>{{$category->created_at->diffForHumans() }}</td>
                            <td><a href ="{{ route('categories.edit', ['id' => $category->id]) }}" class="btn btn-light btn-sm m-1">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
