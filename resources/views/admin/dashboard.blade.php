@extends("admin.layout.base")
@section("title", "Dashboard")


@section("content")
	<div class="dashboard expanded">
		<h2>Dashboard</h2>
		<form action="./admin" method="post" enctype="multipart/form-data">
		  <input name="product" value="testing" type="text">
		  <input name="image" type="file">
		  <input name="submit" value="Go" type="submit">
		</form>
	</div>
@endsection
