@extends("layouts.app")

@section("title", "Home Page")

@section("data-page-id", "home")

@section("content")
<div class="home">
  <div class="hero-slider">
    <div> <img src="<?php echo $_SERVER["APP_URL"] ?>/public/images/sliders/test.jpg" alt="MVC Store"> </div>
    <div> <img src="<?php echo $_SERVER["APP_URL"] ?>/public/images/sliders/test.jpg" alt="MVC Store"> </div>
    <div> <img src="<?php echo $_SERVER["APP_URL"] ?>/public/images/sliders/test.jpg" alt="MVC Store"> </div>
  </div>
  <section class="display-products" data-token="{{ $token }}" id="root">
    <div class="grid-container">
      <h2 class="text-center">Featured Products</h2>
      <div class="grid-x grid-margin-x small-up-2 medium-up-4">
        <div class="cell" v-for="feature in featured" v-cloak>
          <a :href="'<?php echo $_SERVER["APP_URL"] ?>/product/' + feature.id">
            <div class="card" data-equalizer-watch>
              <img :src="'<?php echo $_SERVER["APP_URL"] ?>/public/' + feature.image_path" width="100%" height="200">
              <div class="card-section">
                <p>@{{ stringLimit(feature.name, 18) }}</p>
                <a :href="'<?php echo $_SERVER["APP_URL"] ?>/product/' + feature.id" class="button more expanded">More</a>
                <button v-if="feature.stock > 0" @click.prevent="addToCart(feature.id)" class="button cart expanded">
                  $@{{ feature.price }} - Add to cart
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
                <button v-for="product.stock > 0" @click.prevent="addToCart(product.id)" class="button cart expanded">
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
