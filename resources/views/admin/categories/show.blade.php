@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{$category->name}}</h1>

        @if (count($category->posts))
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category->posts as $post)
                        <tr>
                            <td>{{$post->title}}</td>
                            <td>{{$post->slug}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{route('admin.categories.index')}}" class="btn btn-primary mt-5">Back Categories</a>
    </div>
@endsection