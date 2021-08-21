<div class="grid-x grid-margin-x expanded">
 
  @if (isset($errors))
    <div class="callout alert small-12 cell" data-closable>
      @foreach($errors as $error_array)
        @foreach($error_array as $error_item)
          {{ $error_item }} <br>
        @endforeach
      @endforeach
      
      <button class="close-button" arial-label="Dismiss Message" type="button" data-close>
        <span arial-hidden="true">&times;</span>
      </button>
    </div>
  @endif
  
  @if (isset($success))
    <div class="callout success small-12 cell" data-closable>
      {{ $success }}

      <button class="close-button" arial-label="Dismiss Message" type="button" data-close>
        <span arial-hidden="true">&times;</span>
      </button>
    </div>
  @endif
  
</div>
