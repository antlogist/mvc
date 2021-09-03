@extends("layouts.base")

@section("body")

<!--Navigation-->

@include("includes.nav")

<!--/Navigation-->


<!--Site wrapper-->
<div class="site-wrapper">
  @yield("content")
</div>

@yield("footer")

@stop
