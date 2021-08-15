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
	</div>
@endsection
