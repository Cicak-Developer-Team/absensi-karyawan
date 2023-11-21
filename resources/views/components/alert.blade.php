@if ( session("warning") !== null )
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {!! session("warning") !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if ( session("danger") !== null )
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {!! session("danger") !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if ( session("primary") !== null )
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        {!! session("primary") !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if ( session("success") !== null )
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {!! session("success") !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif