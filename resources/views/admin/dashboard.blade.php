@extends("admin.layout.base")
@section("title", "Dashboard")


@section("content")
	<div class="dashboard expanded">
		<h2>Dashboard</h2>
		{{ $admin }}
		<br>
		<pre>
		  {{ var_dump($_SESSION) }}
		</pre>
		<br>
		{{ \App\Classes\CSRFToken::_token() }}
		<br>
		{!! \App\Classes\Session::get("token") !!}
		<br>
		{!! \App\Classes\CSRFToken::verifyCSRFToken($_SESSION["token"]) !!}
		<br>
		{{ $_SERVER["REQUEST_URI"] }}
		<br>
		<form action="./admin" method="post" enctype="multipart/form-data">
		  <input name="product" value="testing" type="text">
		  <input name="image" type="file">
		  <input name="submit" value="Go" type="submit">
		</form>
		  {{ \App\Classes\Request::all() }}
	</div>
@endsection
