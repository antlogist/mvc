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

      </div>
    </div>
  </form>

</div>
@include("includes.delete-modal")
@endsection
