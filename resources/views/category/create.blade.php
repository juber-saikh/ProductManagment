@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add Category Data
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
      <form method="post" action="{{ route('category.store') }}" enctype="multipart/form-data">
          <div class="form-group">
              @csrf
              <label for="country_name">Category Name:</label>
              <input type="text" class="form-control" name="category_name"/>
          </div>
          <div class="form-group">
              <label for="cases">Category Image :</label>
              <input type="file" name="category_image" class="form-control">
          </div>
          <div class="form-group">
            <label for="cases">Parent Category :</label>
            <input type="text" class="form-control" name="parent_category"/>
        </div>
          <button type="submit" class="btn btn-primary">Add Category</button>
      </form>
  </div>
</div>
@endsection
