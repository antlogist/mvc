@extends("admin.layout.base")
@section("title", "Edit Product")
@section("data-page-id", "adminProduct")

@section("content")

<div class="dashboard expanded grid-container">
  <h2>Edit {{ $product->name }}</h2>

  @include("includes.message")

  <form method="post" action="<?php echo $_SERVER["APP_URL"] ?>/admin/product/edit" enctype="multipart/form-data">
    <div class="grid-x grid-margin-x expanded">

      <!--Product name - text input-->
      <div class="small-12 medium-6 cell">
        <label>Product name:
          <input type="text" name="name" value="{{ $product->name }}">
        </label>
      </div>
      <!--/Product name - text input-->

      <!--Product price - text input-->
      <div class="small-12 medium-6 cell">
        <label>Product price:
          <input type="text" name="price" value="{{ $product->price }}">
        </label>
      </div>
      <!--/Product price - text input-->

      <!--Product cat - select-->
      <div class="small-12 medium-6 cell">
        <label>Product Category:
          <select name="category" id="product-category">
            <option value="{{ $product->category->id }}">
              {{ $product->category->name }}
            </option>
            @foreach($categories as $category)
            <option value="{{ $category['id'] }}"> {{ $category['name'] }}</option>
            @endforeach
          </select>
        </label>
      </div>
      <!--/Product cat - select-->

      <!--Product subcat - select-->
      <div class="small-12 medium-6 cell">
        <label>Product Subcategory:
          <select name="subcategory" id="product-subcategory">
            <option value="{{ $product->subCategory->id }}">
              {{ $product->subCategory->name }}
            </option>
          </select>
        </label>
      </div>
      <!--/Product subcat - select-->

      <!--Product quantity - select-->
      <div class="small-12 medium-6 cell">
        <label>Product Quantity:
          <select name="quantity">
            <option value="{{ $product->quantity }}">
              {{ $product->quantity }}
            </option>
            @for($i = 1; $i <= 50; $i++) <option value="{{ $i }}">{{ $i }}
              </option>
              @endfor
          </select>
        </label>
      </div>
      <!--/Product quantity - select-->

      <!--Product image - input file-->
      <div class="small-12 medium-6 cell">
        <br />
        <div class="input-group"><span class="input-group-label">Product Image:</span>
          <input type="file" name="productImage" class="input-group-field">
        </div>
      </div>
      <!--/Product image - input file-->

      <!--Product description - textarea-->
      <div class="small-12 cell">
        <label>Description:
          <textarea name="description" placeholder="Description">{{ $product->description }}</textarea>
        </label>
        <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::_token() }}">
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <button class="button alert" type="reset">Reset</button>
        <input class="button success float-right" type="submit" value="Save Product">
      </div>
      <!--/Product description - textarea-->

    </div>
  </form>
</div>
@include("includes.delete-modal")
@endsection
