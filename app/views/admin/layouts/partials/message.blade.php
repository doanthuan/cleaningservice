<div class="row" id="message">
    <div class="col-md-12">
        @if( is_object($errors) && $errors->all() )
        <div class="alert alert-danger well-sm">
            <p><strong>{{trans('There was a problem')}}.</strong></p>
            @foreach ($errors->all('<p>:message</p>') as $msg)
            {{ $msg }}
            @endforeach
        </div>
        @elseif(!empty($errors) && is_string($errors))
        <div class="alert alert-danger well-sm">
            {{ $errors }}
        </div>
        @endif

        @if( $success )
        <div class="alert alert-success well-sm">
            {{ $success }}
        </div>
        @endif
    </div>
</div>