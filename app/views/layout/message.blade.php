@if (Session::has('message'))
<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{ Session::get('message') }}
</div>
@endif
@if (Session::has('error'))
<div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{ Session::get('error') }}
</div>
@endif