<script>
    $(document).on('show.bs.modal', '#add_patient', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.bsAction);
        $("#method").val('post');
        modal.removeClass('loading');
        if (data.bsRecordId != undefined) {
            $('.title').text("@lang('Edit Patient')");
            modal.addClass('loading');
            $('.modal_registro_patient_id', modal).val(data.bsRecordId);
            $.getJSON('../patients/' + data.bsRecordId + '/edit', function(data) {
                var obj = data;
                $('#id_user').val(obj.id_user).trigger('change.select2');
                $('#id_status').val(obj.id_status).trigger('change.select2');
                $('#id_marital').val(obj.id_marital).trigger('change.select2');
                $("#form-enviar").attr('action', data.bsAction);
                $("#method").val('put');
                $('#ocupation', modal).val(obj.ocupation);

                modal.removeClass('loading');
            });
        } else {
            $('.title').text("@lang('Add Patient')");
        }
    });
    $(document).on('hidden.bs.modal', '#add_patient', function(e) {
        $('#id_user').val('').trigger('change.select2');
        $('#id_status').val('').trigger('change.select2');
        $('#id_marital').val('').trigger('change.select2');
        $("#method").val('post');
        $('#ocupation').val('');
    });

    // modal familiares
    $(document).on('show.bs.modal', '#add_patientFamily', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $('#birthdate').datetimepicker({
            useCurrent: false,
            format: 'YYYY-MM-DD',
            debug: true,
        })
        $("#form-enviar").attr('action', data.bsAction);
        $("#method").val('post');
        modal.removeClass('loading');
        if (data.bsRecordId != undefined) {
            $('.title').text("@lang('Edit Patient')");
            modal.addClass('loading');
            $('.modal_registro_patientF_id', modal).val(data.bsRecordId);
            $.getJSON('../patients/family/' + data.bsRecordId + '/edit', function(data) {
                var obj = data;
                $('#id_patient').val(obj.id_patient).trigger('change.select2');
                $('#id_marital').val(obj.id_marital).trigger('change.select2');
                $('#id_gender').val(obj.id_gender).trigger('change.select2');
                $('#id_relation').val(obj.id_relation).trigger('change.select2');
                $("#form-enviar").attr('action', data.bsAction);
                $("#method").val('put');
                $('#name', modal).val(obj.name);
                $('#last_name', modal).val(obj.last_name);
                $('#dni', modal).val(obj.dni);
                $('#birthdate', modal).val(obj.birthdate);

                modal.removeClass('loading');
            });
        } else {
            $('.title').text("@lang('Add Patient')");
        }
    });
    $(document).on('hidden.bs.modal', '#add_patientFamily', function(e) {
        $('#id_user').val('').trigger('change.select2');
        $('#id_status').val('').trigger('change.select2');
        $('#id_marital').val('').trigger('change.select2');
        $("#method").val('post');
        $('#ocupation').val('');
    });
</script>
