@extends("layouts.app")

@section("title", "Products")

@section("data-page-id", "subcat")

@section("content")
<div class="products">
  <section class="display-products" data-token="{{ $token }}" id="root">
    <div class="grid-container">
      <h2 class="text-center">Products</h2>
      <div class="grid-x grid-margin-x small-up-2 medium-up-4">

        @if(count($products))

          @foreach($products as $product)

        <div class="cell">

          <a :href="#">
            <div class="card" data-equalizer-watch>
              <img src="<?php echo $_SERVER["APP_URL"] . "/public/" . $product->image_path; ?>">
              <div class="card-section">
                <p>{{ $product->name }}</p>
                <a href="<?php echo $_SERVER["APP_URL"] . "/product/" . $product->id; ?>" class="button more expanded">More</a>

              </div>
            </div>
          </a>
        </div>

          @endforeach

        @endif


      </div>
    </div>
  </section>
</div>
@stop
