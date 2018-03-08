@if(session('success'))
    <div class="alert alert-success">
        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
        <span>{{ session('error') }}</span>
    </div>
@endif


@if(session('warning'))
    <div class="alert alert-warning">
        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
        <span>{{ session('warning') }}</span>
    </div>
@endif


@if(session('flash_message'))
    <div class="alert alert-info">
        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
        <span>{{ session('flash_message') }}</span>
    </div>
@endif