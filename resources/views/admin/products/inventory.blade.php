@extends("admin.layout.base")
@section("title", "Manage Inventory")
@section("data-page-id", "adminProduct")

@section("content")
<div class="product expanded grid-container">
  <h2>Manage Inventory Items</h2>
  
  @include("includes.message")
  
  <div class="grid-x grid-margin-x expanded">
   
   <!--Product page redirect-->
    <div class="small-12 medium-12 cell">
      <a href="<?php echo $_SERVER["APP_URL"] ?>/admin/product/create" class="button float-right">
        <i class="fa fa-plus"></i> Add New Product
      </a>
    </div>
   <!--/Product page redirect-->
    
  </div>

  <div class="grid-x grid-margin-x expanded">
   
    <div class="small-12 medium-12 cell">
      @if(count($products))
      <!--Table-->
      <table class="hover" data-form="deleteForm">
        <tbody>
          @foreach($products as $product)
          <tr>
            <td>
              <img src="<?php echo $_SERVER["APP_URL"] ?>/public/{{ $product['image_path'] }}" alt="{{ $product['name'] }}" height="40" width="40">
            </td>
            <td>{{ $product["name"] }}</td>
            <td>{{ $product["price"] }}</td>
            <td>{{ $product["quantity"] }}</td>
            <td>{{ $product["category_name"] }}</td>
            <td>{{ $product["sub_category_name"] }}</td>
            <td>{{ $product["added"] }}</td>

            <!--Buttons-->
            <td width="100" class="text-right">

              <!--Edit button-->
              <span data-tooltip tabindex="1" title="Edit Product">
                <a href="<?php echo $_SERVER["APP_URL"] ?>/admin/product/{{ $product['id'] }}/edit"><i class="fa fa-edit"></i></a>
              </span>
              <!--/Edit button-->

            </td>
            <!--/Buttons-->
          </tr>
          @endforeach
        </tbody>
      </table>
      <!--/Table-->
      
      {!! $links !!}
      
      @else
      <h3>You haven't any products.</h3>
      @endif
    </div>
    
  </div>
</div>
@endsection
