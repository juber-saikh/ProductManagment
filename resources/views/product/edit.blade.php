@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit Product Data
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
      <form method="post" action="{{ route('products.update', $products->id ) }}" enctype="multipart/form-data">
           <div class="form-group">
                @csrf
                <label for="country_name">Product Name:</label>
                <input type="hidden" name="_method" value="PUT">
                <input type="text" class="form-control" name="product_name" value="{{ $products->product_name }}"/>
            </div>
            <div class="form-group">
                <label for="country_name">Product Description:</label>
                <textarea class="form-control" id="products_description" name="product_description" rows="3">{{ $products->product_description }}</textarea>
            </div>
            <div class="form-group">
                <label for="cases">Product Image :</label>
                <input type="file" name="product_image" class="form-control" value="{{ $products->product_image }}">
                <img src= {{asset('uploads/products/'.$products->product_image)}} style="height: 56px;width: 79px;">
            </div>
            <div class="form-group">
                <label for="cases">Category :</label>
                <select class="custom-select" name="category_id" id="category_id">
                    <option selected>Choose...</option>
                    @foreach($category as $categorys)
                        <option value="{{$categorys->id}}" {{( $categorys->id == $products->category_id) ? 'selected' : '' }}>{{$categorys->category_name}}</option>
                    @endforeach
                </select>
            </div>
          <button type="submit" class="btn btn-primary">Update Data</button>
      </form>
  </div>
</div>
@endsection
