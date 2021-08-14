@extends("admin.layout.base")
@section("title", "Dashboard")


@section("content")
	<div class="dashboard expanded">
		<h2>Dashboard</h2>
		{{ $admin }}
	</div>
@endsection
