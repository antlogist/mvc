@extends("layouts.base")

@section("body")

<!--Navigation-->

@include("includes.nav")

<!--/Navigation-->


<!--Site wrapper-->
<div class="site-wrapper">
  @yield("content")
  
  <div class="notify text-center"></div>
</div>

@yield("footer")

@stop
