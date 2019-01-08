<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ 'Are you sure you want to delete this record?' }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="delete_form" class="d-inline" action="" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        Yes
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('stripts')
    <script src="{{ asset('js/delete_modal.js') }}"></script>
@endpush