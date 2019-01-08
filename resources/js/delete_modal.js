$('#delete_modal').on('show.bs.modal', function (event) {
    $(this).find('#delete_form').attr('action', $(event.relatedTarget).data('action'))
});