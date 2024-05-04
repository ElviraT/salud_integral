<script>
    $(document).ready(function() {
        var gender = $('#gender').val();
        var country = $('#country').val();
        var state = $('#state').val();
        var city = $('#city').val();
        $('#gender_id').val(gender).trigger('change.select2');
        $('#country_id').val(country).trigger('change.select2');
        $('#state_id').val(state).trigger('change.select2');
        $('#city_id').val(city).trigger('change.select2');
        // Detectar cambios en el primer menú selector
        $('#country_id').on('select2:select', function(event) {
            var country_id = $(this).val();
            // Enviar una solicitud AJAX para recuperar las subcategorías relacionadas
            $.ajax({
                url: './combo/' + country_id + '/state',
                method: "GET",

                success: function(data) {
                    var html = "";
                    $.each(data, function(index, value) {
                        html += '<option value="' + value.id + '">' + value.name +
                            "</option>";
                    });
                    $("#state_id").html(html);
                    $("#city_id").html("");
                },
                error: function() {
                    alert("error")
                }
            });
        });

        $("#state_id").on('select2:select', function(event) {
            var state_id = $(this).val();
            // Enviar una solicitud AJAX para recuperar las subcategorías relacionadas
            $.ajax({
                url: './combo/' + state_id + '/city',
                method: "GET",
                success: function(data) {
                    var html = "";
                    $.each(data, function(index, value) {
                        html += '<option value="' + value.id + '">' + value.name +
                            "</option>";
                    });
                    $("#city_id").html(html);
                },
                error: function() {
                    alert("error")
                }
            });
        })
    });

    $(document).on('show.bs.modal', '#bank_details', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.bsAction);
        $("#method").val('post');
        modal.removeClass('loading');
        if (data.bsRecordId != undefined) {
            $('.title').text("@lang('Edit Bank')");
            modal.addClass('loading');
            $('.modal_registro_bank_id', modal).val(data.bsRecordId);
            $.getJSON('../banks/' + data.bsRecordId + '/edit', function(data) {
                var obj = data[0];
                $("#form-enviar").attr('action', data.bsAction);
                $("#method").val('put');
                $('#name', modal).val(obj.name);
                $('#account', modal).val(obj.account);
                $('#titular', modal).val(obj.titular);
                $('#amount', modal).val(obj.amount);
                modal.removeClass('loading');
            });
        } else {
            $('.title').text("@lang('Add Bank')");
        }
    });

    $(document).on('hidden.bs.modal', '#bank_details', function(e) {
        $('#name').val('');
    });
</script>
