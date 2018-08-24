<div class="errorJsSummary" style="display:none;">
    <a href="javascript:void(0)" class="alert-cross" onclick="$(this).closest('div').hide();">
        &times;
    </a>
    <span></span>
</div>
<div class="successmsg" style="display:none;">
    <a href="javascript:void(0)" class="alert-cross" onclick="$(this).closest('div').hide();">
        &times;
    </a>
    <span></span>
</div>
@if(Session::has('success_msg'))
<div class="success_msg ">
    <a href="javascript:void(0)" class="alert-cross" onclick="$(this).closest('div').hide();">
        &times;
    </a>
    {{Session('success_msg')}}
</div>
@endif
@if(Session::has('error_msg'))
<div class="errorSummary alert-cross">
    <a href="javascript:void(0)" class="alert-cross" onclick="$(this).closest('div').hide();">
        &times;
    </a>
    {{Session('error_msg')}}
</div>
@endif