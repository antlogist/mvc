@extends("admin.layout.base")
@section("title", "Product Categories")
@section("data-page-id", "adminCategories")

@section("content")
<div class="dashboard expanded grid-container">
  <h2>Product Categories</h2>
  
  @include("includes.message")
  
  <div class="grid-x grid-margin-x expanded">
   
   <!--Search form-->
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
    <!--/Search form-->
    
    <!--Add new category form-->
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
    <!--/Add new category form-->
    
  </div>

  <div class="grid-x grid-margin-x expanded">
   
    <div class="small-12 medium-12 cell">
      @if(count($categories))
      <!--Table-->
      <table class="hover" data-form="deleteForm">
        <tbody>
          @foreach($categories as $category)
          <tr>
            <td>{{ $category["name"] }}</td>
            <td>{{ $category["slug"] }}</td>
            <td>{{ $category["added"] }}</td>

            <!--Buttons-->
            <td width="100" class="text-right">

              <!--Add-subcategory button-->
              <span data-tooltip tabindex="1" title="Add Subcategory">
                <a href="#" data-open="add-subcategory-{{ $category['id'] }}"><i class="fa fa-plus"></i></a>
              </span>
              <!--/Add-subcategory button-->

              <!--Edit button-->
              <span data-tooltip tabindex="1" title="Edit Category">
                <a href="#" data-open="item-{{ $category['id'] }}"><i class="fa fa-edit"></i></a>
              </span>
              <!--/Edit button-->

              <!--Delete button-->
              <span data-tooltip tabindex="1" title="Delete Category" style="display: inline-block">
                <form method="POST" action="<?php echo $_SERVER["APP_URL"] ?>/admin/product/categories/{{ $category['id'] }}/delete" class="delete-item">
                  <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::_token() }}">
                  <button type="submit"><i class="fa fa-times"></i></button>
                </form>
              </span>
              <!--/Delete button-->

              <!--Edit Category Modal-->
              <div class="reveal" id="item-{{ $category['id'] }}" data-reveal data-close-on-click="false" data-animation-in="scale-in-up" data-animation-out="scale-out-down">
                <div class="notification callout primary"></div>
                <h2>Edit category</h2>
                <!--Form-->
                <form>
                  <div class="input-group">
                    <input id="item-name-{{ $category['id'] }}" type="text" name="name" value="{{ $category['name'] }}">
                    <div>
                      <input type="submit" class="button update-category" id="{{ $category['id'] }}" data-token="{{ \App\Classes\CSRFToken::_token() }}" value="Update">
                    </div>
                  </div>
                </form>
                <!--/Form-->
                <a href="<?php echo $_SERVER["APP_URL"] ?>/admin/product/categories" class="close-button" data-close aria-label="Close modal" type="button">
                  <span aria-hidden="true">&times;</span>
                </a>
              </div>
              <!--/Edit Category Modal-->

              <!--Add Subcategory Modal-->
              <div class="reveal" id="add-subcategory-{{ $category['id'] }}" data-reveal data-close-on-click="false" data-animation-in="scale-in-up" data-animation-out="scale-out-down">
                <div class="notification callout primary"></div>
                <h2>Add Subcategory</h2>
                <!--Form-->
                <form>
                  <div class="input-group">
                    <input id="subcategory-name-{{ $category['id'] }}" type="text">
                    <div>
                      <input type="submit" class="button add-subcategory" id="{{ $category['id'] }}" data-token="{{ \App\Classes\CSRFToken::_token() }}" value="Create">
                    </div>
                  </div>
                </form>
                <!--/Form-->
                <a href="<?php echo $_SERVER["APP_URL"] ?>/admin/product/categories" class="close-button" data-close aria-label="Close modal" type="button">
                  <span aria-hidden="true">&times;</span>
                </a>
              </div>
              <!--/Add Subcategory Modal-->

            </td>
            <!--/Buttons-->
          </tr>
          @endforeach
        </tbody>
      </table>
      <!--/Table-->
      
      {!! $links !!}
      
      @else
      <h3>You haven't any category.</h3>
      @endif
    </div>
    
  </div>
</div>
 
<div class="dashboard expanded grid-container">
  <h3>Subcategories</h3>
  <div class="grid-x grid-margin-x expanded">
    <div class="small-12 medium-12 cell">
     
      @if(count($subcategories))
      <table class="hover" data-form="deleteForm">
        <tbody>
          @foreach($subcategories as $subcategory)
          <tr>
            <td>{{ $subcategory["name"] }}</td>
            <td>{{ $subcategory["slug"] }}</td>
            <td>{{ $subcategory["added"] }}</td>
            
            <!--Buttons-->
            <td width="100" class="text-right">

              <!--Edit button-->
              <span data-tooltip tabindex="1" title="Edit Subategory">
                <a href="#" data-open="item-subcategory-{{ $subcategory['id'] }}"><i class="fa fa-edit"></i></a>
              </span>
              <!--/Edit button-->

              <!--Delete button-->
              <span data-tooltip tabindex="1" title="Delete Subcategory" style="display: inline-block">
                <form method="POST" action="<?php echo $_SERVER["APP_URL"] ?>/admin/product/subcategory/{{ $subcategory['id'] }}/delete" class="delete-item">
                  <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::_token() }}">
                  <button type="submit"><i class="fa fa-times"></i></button>
                </form>
              </span>
              <!--/Delete button-->
              
              
              <!--Edit Subcategory Modal-->
              <div class="reveal" id="item-subcategory-{{ $subcategory['id'] }}" data-reveal data-close-on-click="false" data-animation-in="scale-in-up" data-animation-out="scale-out-down">
                <div class="notification callout primary"></div>
                <h2>Edit subcategory</h2>
                <!--Form-->
                <form>
                  <div>
                   <div>
                      <input id="item-subcategory-name-{{ $subcategory['id'] }}" type="text" value="{{ $subcategory['name'] }}">
                   </div>
                   
                    <div>
                      <label>Change Category
                        <select name="" id="item-category-{{ $subcategory['category_id'] }}">
                          @foreach(App\Models\Category::all() as $category)
                            @if ($category["id"] == $subcategory["category_id"])
                              <option selected value="{{ $category['id'] }}">{{ $category["name"] }}</option>
                            @else
                              <option value="{{ $category['id'] }}">{{ $category["name"] }}</option>
                            @endif
                          @endforeach
                        </select>
                      </label>   
                    </div>
                    
                    <div>
                      <input type="submit" class="button update-subcategory" id="{{ $subcategory['id'] }}" data-category-id="{{ $category['id'] }}" data-token="{{ \App\Classes\CSRFToken::_token() }}" value="Update">
                    </div>
                  </div>
                </form>
                <!--/Form-->
                <a href="<?php echo $_SERVER["APP_URL"] ?>/admin/product/categories" class="close-button" data-close aria-label="Close modal" type="button">
                  <span aria-hidden="true">&times;</span>
                </a>
              </div>
              <!--/Edit Subcategory Modal-->
              
            </td>
            
          </tr>
          @endforeach
        </tbody>
      </table>
      
      {!! $subcategories_links !!}
      
      @else
      <h3>You haven't any subcategory.</h3>
      @endif
    </div>
  </div>
</div>
@include("includes.delete-modal")
@endsection
