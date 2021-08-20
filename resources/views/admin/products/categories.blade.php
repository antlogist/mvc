@extends("admin.layout.base")
@section("title", "Product Categories")


@section("content")
<div class="dashboard expanded grid-container">
  <h2>Product Categories</h2>
  <p>{{ isset($message) ? $message : '' }}</p>
  <div class="grid-x grid-margin-x expanded">
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
  </div>

  <div class="grid-x grid-margin-x expanded">
    <div class="small-12 medium-12 cell">
      @if(count($categories))
      <table class="hover">
        <tbody>
          @foreach($categories as $category)
          <tr>
            <td>{{ $category["name"] }}</td>
            <td>{{ $category["slug"] }}</td>
            <td>{{ $category["added"] }}</td>
            <td width="100" class="text-right">
              <a href="#"><i class="fa fa-edit"></i></a>
              <a href="#"><i class="fa fa-times"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {!! $links !!}
      @else
      <h3>You haven't any category.</h3>
      @endif
    </div>
  </div>
</div>
@endsection
