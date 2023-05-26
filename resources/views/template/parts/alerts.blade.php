@if ($message = Session::get('success'))
<div class="alert-app alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <i class="fa fa-check-circle" aria-hidden="true"></i> {!! $message !!}
</div>
@endif
  
@if ($message = Session::get('error'))
<div class="alert-app alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <i class="fa fa-times-circle" aria-hidden="true"></i> {!! $message !!}
</div>
@endif
   
@if ($message = Session::get('warning'))
<div class="alert-app alert alert-warning alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <i class="fa fa-exclamation-circle" aria-hidden="true"></i> {!! $message !!}
</div>
@endif
   
@if ($message = Session::get('info'))
<div class="alert-app alert alert-info alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <i class="fa fa-info-circle" aria-hidden="true"></i> {!! $message !!}
</div>
@endif
  
@if ($errors->any())
<div class="alert-app alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <i class="fa fa-times-circle" aria-hidden="true"></i>
    Please check the form below for errors
</div>
@endif
