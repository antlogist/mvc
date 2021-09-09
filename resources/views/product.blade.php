@extends("layouts.app")

@section("title") {{ $product->name }} @endsection

@section("data-page-id", "product")

@section("content")
<div class="product" id="product" data-token="{{ $token }}" data-id="{{ $product->id }}" style="padding-top: 6rem;">

  <div class="text-center">
    <i v-show="loading" class="fa fa-spinner fa-spin" style="font-size: 3rem; padding: 3rem; position: fixed; top: 40%; color: black;"></i>
  </div>

  <section class="item-container grid-container">

    <nav aria-label="You are here:" role="navigation">
      <ul class="breadcrumbs">
        <li><a href="#">Product Category</a></li>
        <li><a href="#">Product Subcategory</a></li>
        <li>Product Name</li>
      </ul>
    </nav>

    <div class="cell small-4">
      <div class="card">
        <img src="/mvc/public/{{ $product->image_path }}" width="200" height="200">
        <p>{{ $product->name }}</p>
      </div>
    </div>
  </section>
</div>
