<script src="{{ asset('assets/plugins/select2/js/custom-select.js') }}"></script>
<script src="{{ asset('js/index.global.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
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
                    'start': ev.start,
                    'end': ev.end,
                    'duration': ev.duration,
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
                forceEventDuration: true,
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

                dateClick: function(info) {
                    const selectedDate = info
                        .dateStr; // Obtener la fecha seleccionada como cadena
                    console.log(selectedDate);
                    const formattedDate = new Date(selectedDate).toLocaleDateString(
                        'es-ES'); // Formatear la fecha para su visualización en español
                    const formattedTime = new Date(selectedDate).toLocaleTimeString(
                        'es-ES'); // Formatear la fecha para su visualización en español
                    // Actualizar el contenido del modal con la fecha seleccionada
                    document.getElementById('start').value = formattedDate;
                    document.getElementById('end').value = formattedDate;
                    document.getElementById('startime').value = formattedTime;
                    // console.log(formattedDate);
                    // Mostrar el modal
                    $('#add_event').modal('show');
                },

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
        $("#id_patiente, #id_type, id_familiar").select2({
            dropdownParent: "#add_event"
        });
        $("#method").val('post');

        var id_event = $('#id').val();
        if (id_event != '') {
            $('.title').text("@lang('Edit Cita')");
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
                $('#id_familiar').val(data.id_familiar).trigger('change.select2');
                $('#startime').attr('disabled', false).val(data.startime);
                $('#endtime').attr('disabled', false).val(data.endtime);
                $('#color').val(data.color);
            });
        } else {
            $('#btnEliminar').attr('hidden', true);
            var action = "{{ route('citas.store') }}";
            $("#form-enviar").attr('action', action);
            $('.title').text("@lang('Add Cita')");
            var medical = $('#combo_medical').val();
            $('#id_medical').val(medical);

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
        $('#startime').attr('disabled', true).val('');
        $('#endtime').attr('disabled', true).val('');
        $('#color').val('');
        $('#startRecur').val('');
        $('#endRecur').val('');
    });

    $(document).ready(function() {
        $("#id_patient").on('select2:select', function(event) {
            var patiente = $(this).val();
            var texto = $(this).find('option:selected').text();
            // Enviar una solicitud AJAX para recuperar las subcategorías relacionadas
            $.ajax({
                url: './combo/' + patiente + '/familiar',
                method: "GET",
                success: function(data) {
                    var title = texto;
                    $('#title').val(title);
                    var html = "";
                    html += '<option value="">Seleccione un familiar</option>';
                    $('#id_familiar').attr('disabled', false);
                    $.each(data, function(index, value) {
                        html += '<option value="' + value.id + '">' +
                            value.name +
                            "</option>";
                    });
                    $("#id_familiar").html(html);
                },
                error: function() {
                    alert("error")
                }
            });
        });
    });

    $(document).ready(function() {
        $("#id_service").on('select2:select', function(event) {
            var servicio = $(this).val();
            // Enviar una solicitud AJAX para recuperar las subcategorías relacionadas
            $.ajax({
                url: './combo/' + servicio + '/duracion',
                method: "GET",
                success: function(data) {
                    var horaElemento = $('#startime').val();
                    var momentoHora = moment(horaElemento, "H:mm:ss");
                    momentoHora.add(data.time_aprox, 'minutes');
                    // Format the resulting time
                    var duracion = momentoHora.format("H:mm:ss");
                    $('#endtime').val(duracion);
                    $('#duration').val(data.time_aprox);
                },
                error: function() {
                    alert("error")
                }
            });
        });
    });
</script>
