@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit Category Data
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('category.update', $category->id ) }}" enctype="multipart/form-data">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Category Name:</label>
              <input type="text" class="form-control" name="category_name" value="{{ $category->category_name }}"/>
          </div>
          <div class="form-group">
              <label for="cases">Category Image :</label>
              <input type="file" name="category_image" class="form-control" value="{{ $category->category_image }}">
              <img src= {{asset('uploads/category/'.$category->category_image)}} style="height: 56px;width: 79px;">
          </div>
          <div class="form-group">
            <label for="cases">Parent Category :</label>
            <input type="text" class="form-control" name="parent_category" value="{{ $category->parent_category }}"/>
          </div>
          <button type="submit" class="btn btn-primary">Update Data</button>
      </form>
  </div>
</div>
@endsection
