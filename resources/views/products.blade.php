@extends("layouts.app")

@section("title", "Products")

@section("data-page-id", "products")

@section("content")
<div class="products">
  <section class="display-products" data-token="{{ $token }}" id="root">

    <div class="text-center">
      <i v-show="loading" class="fa fa-spinner fa-spin" style="font-size: 3rem; padding: 3rem; position: fixed; top: 40%; color: black;"></i>
    </div>
  </section>
</div>
@stop
