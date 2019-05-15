<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">@yield('title')</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>

        <div class="modal-body">
            @section('body')
            @show
        </div>

        <div class="modal-footer">
            @section('footer')
            @show
        </div>
    </div>
</div>
