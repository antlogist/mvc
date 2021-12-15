@extends("layouts.app")

@section("title") {{ $product->name }} @endsection

@section("data-page-id", "product")

@section("content")
<div class="product" id="product" data-token="{{ $token }}" data-id="{{ $product->id }}" style="padding-top: 6rem;">

  <div class="text-center">
    <i v-show="loading" class="fa fa-spinner fa-spin" style="font-size: 3rem; padding: 3rem; position: fixed; top: 40%; color: black;"></i>
  </div>

  <section class="item-container grid-container" v-if="loading == false">

    <nav aria-label="You are here:" role="navigation">
      <ul class="breadcrumbs">
        <li><a :href="'<?php echo $_SERVER["APP_URL"] ?>/product-category/' + category.slug">@{{ category.name }}</a></li>
        <li><a :href="'<?php echo $_SERVER["APP_URL"] ?>/product-subcategory/' + subCategory.slug">@{{ subCategory.name }}</a></li>
        <li>@{{ product.name }}</li>
      </ul>
    </nav>

    <div class="grid-x">
      <div class="cell small-12 medium-5 large-4">
        <img :src="'/mvc/public/' + product.image_path" width="100%" height="200">
      </div>
      <div class="cell small-12 medium-7 large-8">
        <div class="product-details grid-container">
          <h2>@{{ product.name }}</h2>
          <p>@{{ product.description }}</p>
          <h2>$@{{ product.price }}</h2>
          <button v-if="product.quantity > 0" @click="addToCart(product.id)" class="button alert">Add to cart</button>
          <button v-else class="button alert">Out of stock</button>
        </div>
      </div>
    </div>
  </section>

  <section class="home" v-if="loading == false && similarProducts">
    <div class="display-products">
      <div class="grid-container">
        <div class="grid-x grid-margin-x small-up-2 medium-up-4">
          <div class="cell" v-for="similar in similarProducts" v-cloak>
            <a :href="'<?php echo $_SERVER["APP_URL"] ?>/product/' + similar.id">
              <div class="card" data-equalizer-watch>
                <img :src="'<?php echo $_SERVER["APP_URL"] ?>/public/' + similar.image_path" width="100%" height="200">
                <div class="card-section">
                  <p>@{{ stringLimit(similar.name, 18) }}</p>
                  <a :href="'<?php echo $_SERVER["APP_URL"] ?>/product/' + similar.id" class="button more expanded">More</a>
                  <a v-if="similar.quantity > 0" @click="addToCart(similar.id)" class="button cart expanded">
                    $@{{ similar.price }} - Add to cart
                  </a>
                  <a v-else href="javascript:avoid(0)" class="button cart expanded">
                    Out of stock
                  </a>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
