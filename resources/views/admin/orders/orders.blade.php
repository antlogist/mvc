@extends("admin.layout.base")
@section("title", "Orders")
@section("data-page-id", "adminOrder")

@section("content")
<div class="product expanded grid-container">
  <h2>@yield('title')</h2>

  @include("includes.message")

  @if(count($orders))
  <table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Date</th>
      <th>User Name</th>
      <th>Product</th>
      <th>Quantity</th>
      <th>Price</th>
      <th>Payment</th>
      <th>Total</th>
    </tr>
  </thead>

  <tbody>
    @foreach($orders as $order)
    <tr>
      <td>{{ $order["id"] }}</td>
      <td>{{ $order["added"] }}</td>
      <td>{{ $order["user_name"] }}</td>
      <td>{{ $order["product_name"] }}</td>
      <td>{{ $order["quantity"] }}</td>
      <td>{{ $order["unit_price"] }}</td>
      <td>{{ $order["payment_status"] }}</td>
      <td>{{ $order["total"] }}</td>
    </tr>
    @endforeach
  </tbody>
</table>

{!! $links !!}

  @else
    <h3>You haven't any orders.</h3>
  @endif


</div>
@endsection
