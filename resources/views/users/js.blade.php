<script>
    $(document).on('show.bs.modal', '#add_user', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        $('#blah').attr("src", "{{ asset('assets/img/avatar.png') }}");
        $('#brithday').datetimepicker({
            useCurrent: false,
            format: 'DD-MM-YYYY',
            debug: true,
        })
        modal.addClass('loading');
        $("#form-enviar").attr('action', data.bsAction);
        $("#method").val('post');
        if (data.bsRecordId != undefined) {
            $('.title').text("@lang('Edit User')");
            $('.modal_registro_user_id', modal).val(data.bsRecordId);
            $.getJSON('../users/' + data.bsRecordId + '/edit', function(data) {
                var obj = data[0];
                var url = "{{ asset(Storage::url('avatar/:img')) }}";
                var avatar = url.replace(':img', obj.avatar);
                $('#gender_id').val(obj.gender_id).trigger('change.select2');
                $('#country_id').val(obj.country_id).trigger('change.select2');
                $('#state_id').val(obj.state_id).trigger('change.select2');
                $('#city_id').val(obj.city_id).trigger('change.select2');
                $('#status').val(obj.status).trigger('change.select2');
                $("#form-enviar").attr('action', data.bsAction);
                $("#method").val('put');
                $('#name', modal).val(obj.name);
                $('#last_name', modal).val(obj.last_name);
                $('#dni', modal).val(obj.dni);
                $('#email', modal).val(obj.email);
                $('#movil', modal).val(obj.movil);
                $('#brithday', modal).val(obj.brithday);
                $('#address', modal).val(obj.address);
                if (obj.avatar != null) {
                    $('#blah').attr("src", avatar);
                }
            });
        } else {
            $('.title').text("@lang('Add User')");
        }
    });
    $(document).on('hidden.bs.modal', '#add_user', function(e) {
        $('#name').val('');
        $('#gender_id').val('').trigger('change.select2');
        $('#country_id').val('').trigger('change.select2');
        $('#state_id').val('').trigger('change.select2');
        $('#city_id').val('').trigger('change.select2');
        $('#status').val('').trigger('change.select2');
        $("#method").val('post');
        $('#last_name').val('');
        $('#dni').val('');
        $('#email').val('');
        $('#movil').val('');
        $('#brithday').val('');
        $('#address').val('');
        $('#blah').attr("src", "{{ asset('assets/img/avatar.png') }}");
    });
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
</script>
