@section('footer')
<div id="footer">
    <div class="container">
    </div>
</div>

<script src="{{url('js/bootstrap.min.js')}}"></script>
<script src="{{url('js/goxob.js')}}"></script>
<script>
    $(document).ready(function(){
        $( 'input[required="required"]')
            .closest(".form-group")
            .children("label")
            .append("<i class='glyphicon-asterisk'></i> ");
    });
</script>
@show