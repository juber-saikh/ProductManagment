@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
    <a href="{{ route('category.create')}}" class="btn btn-primary">Add Category</a>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Category Name</td>
          <td>Category Image</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($category as $categoryes)
        <tr>
            <td>{{$categoryes->id}}</td>
            <td>{{$categoryes->category_name}}</td>
            <td> <img src= {{asset('uploads/category/'.$categoryes->category_image)}} style="height: 56px;width: 79px;"></td>
            <td><a href="{{ route('category.edit', $categoryes->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('category.destroy', $categoryes->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection
