<script>
    $(document).on('show.bs.modal', '#add_service', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.bsAction);
        $("#method").val('post');
        modal.removeClass('loading');
        if (data.bsRecordId != undefined) {
            $('.title').text("@lang('Edit Service')");
            modal.addClass('loading');
            $('.modal_registro_service_id', modal).val(data.bsRecordId);
            $.getJSON('../services/' + data.bsRecordId + '/edit', function(data) {
                var obj = data;
                $("#form-enviar").attr('action', data.bsAction);
                $("#method").val('put');
                $('#id_speciality').val(obj.id_speciality).trigger('change.select2');
                $('#name', modal).val(obj.name);
                $('#amount', modal).val(obj.amount);
                $('#time_aprox', modal).val(obj.time_aprox);
                modal.removeClass('loading');
            });
        } else {
            $('.title').text("@lang('Add Service')");
        }
    });

    $(document).on('hidden.bs.modal', '#add_service', function(e) {
        $('#name').val('');
        $('#amount').val('');
        $('#time_aprox').val('');
        $('#id_speciality').val('').trigger('change.select2');
    });
</script>
