<script src="{{ asset('assets/plugins/select2/js/custom-select.js') }}"></script>
<script src="{{ asset('js/index.global.js') }}"></script>
<script>
    $("#combo_medical").on('select2:select', function(event) {
        var id = $(this).val();
        // // listar eventos cargados
        var url = "{{ route('citas.mostrar', ':id') }}";
        url = url.replace(':id', id);
        var array_evento = []
        $.getJSON(url, function(event) {
            for (const ev of event) {
                const clase = {
                    'id': ev.id,
                    'title': ev.title,
                    'startTime': ev.startime,
                    'endTime': ev.endtime,
                    'color': ev.color, // Fecha de finalización de la recurrencia

                }
                array_evento.push(clase);
            }
        });

        $.getJSON('./medical-time/' + id, function(objch) {
            var array_businessHours = [];
            var hora_minima = '07:00:00';
            var hora_maxima = '06:59:59';
            var day_laborable = []
            loading_show();
            for (const registro of objch) {
                day_laborable.push(registro.id_day);
                const dia = {
                    start: registro.start_hour,
                    end: registro.end_hour,
                    dow: [registro.id_day]
                };
                array_businessHours.push(dia);
            }
            const day = [0, 1, 2, 3, 4, 5, 6];
            const noLaborable = compareArrays(day, day_laborable);
            $('#cita').attr('hidden', false);

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                allDay: false,
                locale: 'es',
                timeZone: 'América/Santiago',
                events: array_evento,
                initialView: 'timeGridWeek',
                hiddenDays: noLaborable,
                droppable: false,
                businessHours: array_businessHours,
                timeZoneName: 'short',

                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                },


                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                editable: true,

                eventClick: function(info) {
                    $('#id').val(info.event.id);
                    $('#btnEliminar').attr('hidden', false);
                    $('#add_event').modal('show');

                }

            });
            loading_hide();
            calendar.render();
            document.getElementById('btnEliminar').addEventListener('click', function() {
                var id_event = $('#id').val();
                var url_borrar = "{{ route('citas.destroy', ':id') }}";
                url_borrar = url_borrar.replace(':id', id_event);

                // Eliminar evento de la base de datos
                $.ajax({
                    url: url_borrar,
                    method: 'get',
                    success: function() {
                        // location.reload();
                    }
                });
            });
        });
    });

    function compareArrays(array1, array2) {
        // Create a set from each array to efficiently check for unique values
        const set1 = new Set(array1);
        const set2 = new Set(array2);

        // Find values unique to both arrays
        const intersection = new Set([...array1].filter(x => set2.has(x)));

        // Find values that don't match in either array
        const differences = [...array1].filter(x => !intersection.has(x)).concat([...array2]
            .filter(x => !intersection.has(x)));

        // Return the array of mismatched values
        return differences;
    }

    //CONTROL MODAL EVENTS
    $(document).on('show.bs.modal', '#add_event', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        $("#id_patiente, #id_type, #id_day").select2({
            dropdownParent: "#add_event"
        });
        $("#method").val('post');
        $('#startRecur').datetimepicker({
            useCurrent: false,
            format: 'DD-MM-YYYY',
            debug: true,
        });
        $('#endRecur').datetimepicker({
            useCurrent: false,
            format: 'DD-MM-YYYY',
            debug: true,
        })
        var id_event = $('#id').val();
        if (id_event != '') {
            $('.title').text("@lang('Edit Class')");
            $.getJSON('./citas/' + id_event + '/edit', function(data) {
                var update = "{{ route('citas.update', ':id') }}";
                update = update.replace(':id', id_event);
                $('#form-enviar').attr('action', update);
                $('#method').val('put');
                $('#id_medical').val(data.id_medical);
                $('#id_type').attr('disabled', false);
                $('#id_type').val(data.id_type).trigger('change.select2');
                $('#title').val(data.title);
                $('#id_patient').val(data.id_patient).trigger('change.select2');
                $('#id_day').attr('disabled', false);
                $('#id_day').val(data.id_day).trigger('change.select2');
                $('#startime').attr('disabled', false).val(data.startime);
                $('#endtime').attr('disabled', false).val(data.endtime);
                $('#color').val(data.color);


            });
        } else {
            $('#btnEliminar').attr('hidden', true);
            $("#form-enviar").attr('action', data.bsAction);
            $('.title').text("@lang('Add Class')");
            var medical = $('#combo_medical').val();
            $.getJSON('./consulta/' + medical, function(data) {

                $('#id_medical').val(medical);
                var html = "";
                html += '<option>Seleccione un Día</option>';
                $('#id_day').attr('disabled', false);
                $.each(data, function(index, value) {
                    html += '<option value="' + value.id + '">' + value.name +
                        "</option>";
                });
                $("#id_day").html(html);
            });
        }
    });
    $(document).on('hidden.bs.modal', '#add_event', function(e) {
        $('#id_medical').val('');
        $('#id_matter').attr('disabled', true);
        $('#id_matter').val('').trigger('change.select2');
        $('#btnEliminar').attr('hidden', true);
        $('#id').val('');
        $('#title').val('');
        $('#id_group').attr('disabled', true);
        $('#id_group').val('').trigger('change.select2');
        $('#id_day').attr('disabled', true);
        $('#id_day').val('').trigger('change.select2');
        $('#startime').attr('disabled', true).val('');
        $('#endtime').attr('disabled', true).val('');
        $('#color').val('');
        $('#startRecur').val('');
        $('#endRecur').val('');
    });
    $(document).ready(function() {
        $("#id_day").on('select2:select', function(event) {
            var day = $(this).val();
            var medical = $('#combo_medical').val();
            // Enviar una solicitud AJAX para recuperar las subcategorías relacionadas
            $.ajax({
                url: './consulta2/' + day + '/' + medical,
                method: "GET",
                success: function(data) {
                    var mensaje =
                        'Las horas disponibles para este día son de ' + data
                        .start_hour + ' a ' + data.end_hour;
                    $('#horas').html(mensaje);
                    $('#startime').attr('disabled', false);
                    $('#endtime').attr('disabled', false);

                    // Definir el rango de horas válido
                    var horaInicio = parseInt(data.start_hour.replace(':',
                        '')) * 3600;
                    var horaFin = parseInt(data.end_hour.replace(':', '')) *
                        3600;

                    // Obtener el input time y su valor
                    var inputTime = $("#startime");
                    var inputTime1 = $("#endtime");
                    var horaInput;
                    // Función de validación
                    function validarHora() {
                        horaInput = parseInt(inputTime.val().replace(':', '')) *
                            3600;
                        if (horaInput >= horaInicio && horaInput <= horaFin) {
                            console.log("Hora válida");
                            $('#mensaje').attr('hidden', true);
                        } else {
                            inputTime.val('');
                            $('#mensaje').attr('hidden', false);
                            $('#mensaje').html("Hora no válida");
                        }
                    }
                    // Función de validación
                    function validarHora2() {
                        horaInput = parseInt(inputTime1.val().replace(':',
                            '')) * 3600;
                        if (horaInput >= horaInicio && horaInput <= horaFin) {
                            console.log("Hora válida");
                            $('#mensaje').attr('hidden', true);
                        } else {
                            inputTime1.val('');
                            $('#mensaje').attr('hidden', false);
                            $('#mensaje').html("Hora no válida");
                        }
                    }

                    // Asociar la validación al evento change del input time
                    inputTime.change(validarHora);
                    inputTime1.change(validarHora2);
                },
                error: function() {
                    alert("error")
                }
            });
        });
    });

    $(document).ready(function() {
        $("#id_matter").on('select2:select', function(event) {
            var matter = $(this).val();
            var texto = $(this).find('option:selected').text();

            // Enviar una solicitud AJAX para recuperar las subcategorías relacionadas
            $.ajax({
                url: './title/' + matter,
                method: "GET",
                success: function(data) {
                    var title = texto;
                    $('#title').val(title);
                    var html = "";
                    html += '<option>Seleccione un Grupo</option>';
                    $('#id_group').attr('disabled', false);
                    $.each(data, function(index, value) {
                        html += '<option value="' + value.id + '">' +
                            value.name +
                            "</option>";
                    });
                    $("#id_group").html(html);
                },
                error: function() {
                    alert("error")
                }
            });
        });
    });
    $(document).ready(function() {
        $("#id_group").on('select2:select', function(event) {
            var texto = $(this).find('option:selected').text();
            $("#title").val($("#title").val() + " - " + texto);
        });
    });
</script>
