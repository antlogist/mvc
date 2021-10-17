<div class="grid-x grid-margin-x expanded">

  @if (isset($errors) || \App\Classes\Session::has("error"))
    <div class="callout alert small-12 cell" data-closable>
      @if(\App\Classes\Session::has('error'))
          {{ \App\Classes\Session::flash('error') }}
      @else
          @foreach($errors as $error_array)
              @foreach($error_array as $error_item)
                  {{ $error_item }} <br />
              @endforeach
          @endforeach
      @endif

      <button class="close-button" arial-label="Dismiss Message" type="button" data-close>
        <span arial-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  @if (isset($success) || \App\Classes\Session::has("success"))
    <div class="callout success small-12 cell" data-closable>
      @if (isset($success))
        {{ $success }}
      @elseif(\App\Classes\Session::has("success"))
        {{ \App\Classes\Session::flash("success") }}
      @endif
      <button class="close-button" arial-label="Dismiss Message" type="button" data-close>
        <span arial-hidden="true">&times;</span>
      </button>
    </div>
  @endif

</div>
