@extends("layouts.app")

@section("title", "Products")

@section("data-page-id", "products")

@section("content")
<div class="products">
  <section class="display-products" data-token="{{ $token }}" id="root">
    <div class="grid-container">
      <h2 class="text-center">Product Picks</h2>
      <div class="grid-x grid-margin-x small-up-2 medium-up-4">
        <div class="cell" v-for="product in products" v-cloak>
          <a :href="'<?php echo $_SERVER["APP_URL"] ?>/product/' + product.id">
            <div class="card" data-equalizer-watch>
              <img :src="'/mvc/public/' + product.image_path" width="100%" height="200">
              <div class="card-section">
                <p>@{{ stringLimit(product.name, 18) }}</p>
                <a :href="'<?php echo $_SERVER["APP_URL"] ?>/product/' + product.id" class="button more expanded">More</a>
                <button v-if="product.quantity > 0" @click.prevent="addToCart(product.id)" class="button cart expanded">
                  $@{{ product.price }} - Add to cart
                </button>
                <button v-else class="button cart expanded">
                  Out of stock
                </button>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="text-center">
      <i v-show="loading" class="fa fa-spinner fa-spin" style="font-size: 3rem; padding: 3rem; position: fixed; top: 40%; color: black;"></i>
    </div>
  </section>
</div>
@stop
