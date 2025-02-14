<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-simple">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3>Delete Confirmation</h3>
                    <p>Are you sure about deleting this item?</p>
                </div>
                <form action="#" class="row" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="col-12 text-center demo-vertical-spacing">
                        <button type="submit" class="btn btn-danger me-sm-3 me-1">Delete</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#confirmDeleteModal').modal({
            keyboard: true,
            backdrop: "static",
            show: false,
        }).on('shown.bs.modal', function(e) {
            $(this).find('form').attr('action', $(e.relatedTarget).data('href'));
            $(this).find('.modal-hint').html($(e.relatedTarget).data('hint'));
        });
    });
</script>
