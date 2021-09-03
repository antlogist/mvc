@extends("layouts.app")

@section("title", "Home Page")

@section("data-page-id", "home")

@section("content")
<div class="grid-container">
  <div class="grid-x grid-margin-x">

    <h1>Homepage</h1>
    
    <div class="home">
        
        <section class="hero">
            <div class="hero-slider">
                <div> <img src="mvc/oublic/images/sliders/test.jpg" alt="Acme Store"> </div>
                <div> <img src="mvc/oublic/images/sliders/test.jpg" alt="Acme Store"> </div>
                <div> <img src="mvc/oublic/images/sliders/test.jpg" alt="Acme Store"> </div>
            </div>
        </section>
    </div>

  </div>
</div>

@stop
