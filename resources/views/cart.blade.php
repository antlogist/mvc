@extends("layouts.app")

@section("title", "Your shopping cart")

@section("data-page-id", "cart")

@section("content")
<div class="shopping_cart" id="shoppingCart">

  <div class="text-center">
    <i v-show="loading" class="fa fa-spinner fa-spin" style="font-size: 3rem; padding: 3rem; position: fixed; top: 40%; color: black;"></i>
  </div>

</div>
