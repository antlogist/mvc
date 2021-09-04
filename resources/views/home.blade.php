@extends("layouts.app")

@section("title", "Home Page")

@section("data-page-id", "home")

@section("content")
<div class="home">
  <div class="hero-slider">
    <div> <img src="/mvc/public/images/sliders/test.jpg" alt="MVC Store"> </div>
    <div> <img src="/mvc/public/images/sliders/test.jpg" alt="MVC Store"> </div>
    <div> <img src="/mvc/public/images/sliders/test.jpg" alt="MVC Store"> </div>
  </div>
  <section>
    <div id="root">
      @{{ message }}
    </div>
  </section>
</div>
<script type="text/javascript">
  new Vue({
    el: "#root",
    data: {
      message: "Test message"
    }
  });
</script>
@stop
