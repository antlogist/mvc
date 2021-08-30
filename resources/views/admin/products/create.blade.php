@extends("admin.layout.base")
@section("title", "Create Product")
@section("data-page-id", "adminProducts")

@section("content")

<div class="dashboard expanded grid-container">
  <h2>Add Inventory Item</h2>

  @include("includes.message")

  <form method="post" action="<?php echo $_SERVER["APP_URL"] ?>/admin/product/create">
    <div class="small-12 medium-11">
      <div class="row expanded">
        <div class="small-12 medium-6 cell">
          <label>Product name:
            <input type="text" name="name" placeholder="Product name" value="{{ \App\Classes\Request::old('post', 'name') }}">
          </label>
        </div>

        <div class="small-12 medium-6 cell">
          <label>Product price:
            <input type="text" name="price" placeholder="Product price" value="{{ \App\Classes\Request::old('post', 'price') }}">
          </label>
        </div>

        <div class="small-12 medium-6 cell">
          <label>Product Category:
            <select name="category" id="product-category">
              <option value="{{ \App\Classes\Request::old('post', 'category')?:"" }}">
                {{ \App\Classes\Request::old('post', 'category')?:"Select Category" }}
              </option>
              @foreach($categories as $category)
              <option value="{{ $category['id'] }}"> {{ $category['name'] }}</option>
              @endforeach
            </select>
          </label>
        </div>

        <div class="small-12 medium-6 cell">
          <label>Product Subcategory:
            <select name="subcategory" id="product-subcategory">
              <option value="{{ \App\Classes\Request::old('post', 'subcategory')?:"" }}">
                {{ \App\Classes\Request::old('post', 'subcategory')?:"Select Subcategory" }}
              </option>
            </select>
          </label>
        </div>
      </div>
    </div>
  </form>

</div>
@include("includes.delete-modal")
@endsection
