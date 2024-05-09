<script>
    $(document).on('show.bs.modal', '#add_consulting', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.bsAction);
        $("#method").val('post');
        modal.removeClass('loading');
        if (data.bsRecordId != undefined) {
            $('.title').text("@lang('Edit Consulting')");
            modal.addClass('loading');
            $('.modal_registro_consulting_id', modal).val(data.bsRecordId);
            $.getJSON('../consultings/' + data.bsRecordId + '/edit', function(data) {
                var obj = data;
                $("#form-enviar").attr('action', data.bsAction);
                $("#method").val('put');
                $('#name', modal).val(obj.name);
                $('#phone', modal).val(obj.phone);
                modal.removeClass('loading');
            });
        } else {
            $('.title').text("@lang('Add Consulting')");
        }
    });

    $(document).on('hidden.bs.modal', '#add_consulting', function(e) {
        $('#name').val('');
    });
</script>
