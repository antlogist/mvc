@extends("admin.layout.base")
@section("title", "Product Categories")
@section("data-page-id", "adminCategories")

@section("content")
<div class="dashboard expanded grid-container">
  <h2>Product Categories</h2>
  @include("includes.message")
  <div class="grid-x grid-margin-x expanded">
    <div class="small-12 medium-6 cell">
      <form action="" method="post">
        <div class="input-group">
          <input type="text" class="input-group-field" placeholder="Search by name">
          <div class="input-group-button">
            <input type="button" class="button" value="Search">
          </div>
        </div>
      </form>
    </div>
    <div class="small-12 medium-6 cell">
      <form action="<?php echo $_SERVER["APP_URL"] ?>/admin/product/categories" method="post">
        <div class="input-group">
          <input type="text" name="name" class="input-group-field" placeholder="Category name">
          <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::_token() }}">
          <div class="input-group-button">
            <input type="submit" class="button" value="Create">
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="grid-x grid-margin-x expanded">
    <div class="small-12 medium-12 cell">
      @if(count($categories))
      <table class="hover">
        <tbody>
          @foreach($categories as $category)
          <tr>
            <td>{{ $category["name"] }}</td>
            <td>{{ $category["slug"] }}</td>
            <td>{{ $category["added"] }}</td>
            <td width="100" class="text-right">
              <a href="#" data-open="item-{{ $category['id'] }}"><i class="fa fa-edit"></i></a>
              <a href="#"><i class="fa fa-times"></i></a>
              <!--Edit Category Modal-->
              <div class="reveal" id="item-{{ $category['id'] }}" data-reveal data-close-on-click="false">
               <div class="notification"></div>
                <h2>Edit category</h2>
                <form>
                  <div class="input-group">
                    <input id="item-name-{{ $category['id'] }}" type="text" name="name" value="{{ $category['name'] }}">
                    <div>
                      <input type="submit" class="button update-category" id="{{ $category['id'] }}" data-token="{{ \App\Classes\CSRFToken::_token() }}" value="Update">
                    </div>
                  </div>
                </form>
                <button class="close-button" data-close aria-label="Close modal" type="button">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {!! $links !!}
      @else
      <h3>You haven't any category.</h3>
      @endif
    </div>
  </div>
</div>
@endsection
