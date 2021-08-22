@extends("admin.layout.base")
@section("title", "Dashboard")

@section("content")
<div class="expanded grid-container">
  <div class="dashboard grid-x grid-margin-x expanded">
    <div class="small-12 cell">
      <h2>Dashboard</h2>
      <form action="./admin" method="post" enctype="multipart/form-data">
        <input name="product" value="testing" type="text">
        <input name="image" type="file">
        <input name="submit" value="Go" type="submit">
      </form>
    </div>
  </div>
</div>
@endsection
