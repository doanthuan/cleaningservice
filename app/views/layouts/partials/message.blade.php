<div class="row" id="message">
    <div class="col-md-12">
        @if( is_object($errors) && $errors->all() )
            <div class="alert alert-danger well-sm alert-dismissible">
                <p><strong>{{trans('There was a problem')}}.</strong></p>
                @foreach ($errors->all('<p>:message</p>') as $msg)
                    {{ $msg }}
                @endforeach
            </div>
        @elseif(!empty($errors) && is_string($errors))
        <div class="alert alert-danger well-sm alert-dismissible">
        {{ $errors }}
        </div>
        @endif

        @if( isset($success) && !empty($success) )
            <div class="alert alert-success well-sm alert-dismissible">
                {{ $success }}
            </div>
        @endif
    </div>
</div>