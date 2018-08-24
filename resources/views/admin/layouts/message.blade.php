@if(Session::has('success_msg'))
<div class="alert alert-success alert-dismissible fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	 </button>
  {{Session('success_msg')}}
</div>
@endif

@if(Session::has('error_msg'))
<div class="alert alert-danger alert-dismissible fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	 </button>
  {{Session('error_msg')}}
</div>
@endif

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