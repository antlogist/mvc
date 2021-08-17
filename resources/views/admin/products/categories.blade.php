@extends("admin.layout.base")
@section("title", "Product Categories")


@section("content")
	<div class="dashboard expanded">
		<h2>Product Categories</h2>
		{{ $categories }}
		<div class="row expanded">
		  <div class="small-12 medium-6 column">
		    <form action="" method="post">
		      <div class="input-group">
		        <input type="text" class="input-group-field" placeholder="Search by name">
		        <div class="input-group-button">
		          <input type="button" class="button" value="Search">
		        </div>
		      </div>
		    </form>
		  </div>
		  
		  <div class="small-12 medium-6 column">
		    <form action="./admin/products/categories" method="post">
		      <div class="input-group">
		        <input type="text" name="name" class="input-group-field" placeholder="Category name">
		        <div class="input-group-button">
		          <input type="button" class="button" value="Search">
		        </div>
		      </div>
		    </form>
		  </div>
		</div>
	</div>
@endsection
