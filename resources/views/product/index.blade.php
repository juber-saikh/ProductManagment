@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
    <a href="{{ route('products.create')}}" class="btn btn-primary" style="margin: 10x;margin-bottom: 10px">Add Products</a>
    <div class="d-inline p-2">
        <input type="text" class="form-control" placeholder="Enter Product Name" id='product_name' name="product_name"/ style="height: 50px;width: 250px;" value="{{request()->get('prod')}}" >
    </div>
    <div class="d-inline p-2">
        <select class="custom-select" name="category_id" id="mySelect" style="height: 50px;width: 250px;"  >
        <option selected value="choose">Choose...</option>

        @foreach($category as $categorys)

        @php
            $sel='';
            if(!empty(request()->get('cat')) && request()->get('cat')==$categorys->category_name){
                    $sel='selected';
            }
        @endphp


            <option value="{{$categorys->category_name}}" {{$sel}}>  {{$categorys->category_name}}  </option>
        @endforeach
        </select>
    </div>
    <div class="d-inline p-2 bg-dark text-white" onclick="goToPage()">Search</div>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Product Name</td>
          <td>Product Image</td>
          <td>Category Name</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->product_name}}</td>
            <td><img src= {{asset('uploads/products/'.$product->product_image)}} style="height: 56px;width: 79px;"></td>
            <td>{{$product->categoryname->category_name}}</td>
            <td><a href="{{ route('products.edit', $product->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('products.destroy', $product->id)}}" method="post">
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

<script>
    function goToPage(){
         var category = document.getElementById("mySelect").value
        window.location.href='/products?cat='+category+'&prod='+document.getElementById('product_name').value;
        //alert(val);
    }
    </script>
