@extends('layouts.app')
@section('title', 'Login to Your Account')
@section('data-page-id', 'auth')

@section('content')
<div class="auth grid-container" id="auth" style="margin-top: 7rem;">
  <section class="login_form" style="max-width: 720px; margin: 0 auto;">
    <div class="row">
      <div class="small-12 medium-7 medium-centered">
        <h2 class="text-center">Login</h2>
        @include('includes.message')
        <form action="/mvc/login" method="post">
          <input type="text" name="username" placeholder="Your Username or Email"
                  value="{{ \App\Classes\Request::old('post', 'username') }}">

          <input type="password" name="password" placeholder="Your Password">
          <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::_token() }}">
          <button class="button float-right">Login</button>
        </form>
        <p>Not yet a member? <a href="/mvc/register">Register Here</a> </p>
      </div>
    </div>
  </section>
</div>
@stop