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
      <table class="hover" data-form="deleteForm">
        <tbody>
          @foreach($categories as $category)
          <tr>
            <td>{{ $category["name"] }}</td>
            <td>{{ $category["slug"] }}</td>
            <td>{{ $category["added"] }}</td>
            <td width="100" class="text-right">
              <!--Add-subcategory button-->
              <span data-tooltip tabindex="1" title="Add Subcategory">
                <a href="#" data-open="add-subcategory-{{ $category['id'] }}"><i class="fa fa-plus"></i></a>
              </span>
              <!--Edit button-->
              <span data-tooltip tabindex="1" title="Edit Category">
                <a href="#" data-open="item-{{ $category['id'] }}"><i class="fa fa-edit"></i></a>
              </span>
              <!--Delete button-->
              <span data-tooltip tabindex="1" title="Delete Category" style="display: inline-block">
                <form method="POST" action="<?php echo $_SERVER["APP_URL"] ?>/admin/product/categories/{{ $category['id'] }}/delete" class="delete-item">
                  <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::_token() }}">
                  <button type="submit"><i class="fa fa-times"></i></button>
                </form>
              </span>
              <!--Edit Category Modal-->
              <div class="reveal" id="item-{{ $category['id'] }}" data-reveal data-close-on-click="false" data-animation-in="scale-in-up" data-animation-out="scale-out-down">
                <div class="notification callout primary"></div>
                <h2>Edit category</h2>
                <form>
                  <div class="input-group">
                    <input id="item-name-{{ $category['id'] }}" type="text" name="name" value="{{ $category['name'] }}">
                    <div>
                      <input type="submit" class="button update-category" id="{{ $category['id'] }}" data-token="{{ \App\Classes\CSRFToken::_token() }}" value="Update">
                    </div>
                  </div>
                </form>
                <a href="<?php echo $_SERVER["APP_URL"] ?>/admin/product/categories" class="close-button" data-close aria-label="Close modal" type="button">
                  <span aria-hidden="true">&times;</span>
                </a>
              </div>
              <!--/Edit Category Modal-->
              <!--Add Subcategory Modal-->
              <div class="reveal" id="add-subcategory-{{ $category['id'] }}" data-reveal data-close-on-click="false" data-animation-in="scale-in-up" data-animation-out="scale-out-down">
                <div class="notification callout primary"></div>
                <h2>Add Subcategory</h2>
                <form>
                  <div class="input-group">
                    <input id="subcategory-name-{{ $category['id'] }}" type="text">
                    <div>
                      <input type="submit" class="button add-subcategory" id="{{ $category['id'] }}" data-token="{{ \App\Classes\CSRFToken::_token() }}" value="Create">
                    </div>
                  </div>
                </form>
                <a href="<?php echo $_SERVER["APP_URL"] ?>/admin/product/categories" class="close-button" data-close aria-label="Close modal" type="button">
                  <span aria-hidden="true">&times;</span>
                </a>
              </div>
              <!--/Add Subcategory Modal-->
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
@include("includes.delete-modal")
@endsection
