@extends("admin.layout.base")
@section("title", "Orders")
@section("data-page-id", "adminOrder")

@section("content")
<div class="product expanded grid-container">
  <h2>@yield('title')</h2>

  @include("includes.message")

  @if(count($payments))
  <table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Date</th>
      <th>User Name</th>
      <th>Amount</th>
      <th>Status</th>
    </tr>
  </thead>

  <tbody>
    @foreach($payments as $payment)
    <tr>
      <td>{{ $payment["id"] }}</td>
      <td>{{ $payment["added"] }}</td>
      <td>{{ $payment["user_name"] }}</td>
      <td>{{ $payment["amount"] }}</td>
      <td>{{ $payment["status"] }}</td>
    </tr>
    @endforeach
  </tbody>
</table>

{!! $links !!}

  @else
    <h3>You haven't any payments.</h3>
  @endif


</div>
@endsection
