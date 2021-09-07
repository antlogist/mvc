@extends("layouts.app")

@section("title", "Home Page")

@section("data-page-id", "home")

@section("content")
<div class="home">
  <div class="hero-slider">
    <div> <img src="/mvc/public/images/sliders/test.jpg" alt="MVC Store"> </div>
    <div> <img src="/mvc/public/images/sliders/test.jpg" alt="MVC Store"> </div>
    <div> <img src="/mvc/public/images/sliders/test.jpg" alt="MVC Store"> </div>
  </div>
  <section class="display-products" id="root">
    <div class="grid-container">
      <h2 class="text-center">Featured Products</h2>
      <div class="grid-x grid-margin-x small-up-2 medium-up-4">
        <div class="cell" v-for="feature in featured">
          <a :href="'/mvc/product/' + feature.id">
            <div class="card" data-equalizer-watch>
              <img :src="'/mvc/public/' + feature.image_path" width="100%" height="200">
              <div class="card-section">
                <p>@{{ stringLimit(feature.name, 18) }}</p>
                <a :href="'/mvc/product/' + feature.id" class="button more expanded">More</a>
                <a :href="'/mvc/product/' + feature.id" class="button cart expanded">
                  $@{{ feature.price }} - Add to cart
                </a>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>
</div>
@stop
