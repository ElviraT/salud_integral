<script>
    $(document).on('show.bs.modal', '#add_ticket', function(e) {
        $('#due_date').datetimepicker({
            useCurrent: false,
            format: 'DD-MM-YYYY',
            debug: true,
        })
    })

    $(document).on('show.bs.modal', '#img_details', function(e) {
        var modal = $(e.delegateTarget),
            data = $(e.relatedTarget).data();
        modal.addClass('loading');
        if (data.bsRecordId != undefined) {
            modal.addClass('loading');
            $.getJSON('../' + data.bsRecordId + '/img', function(data) {
                var obj = data;
                var url = "{{ asset(Storage::url('comment/:img')) }}";
                var image = url.replace(':img', obj.image);
                $('#img').attr("src", image);
                modal.removeClass('loading');
            });
        }
    });
    $(document).on('hidden.bs.modal', '#img_details', function(e) {
        $('#img').val("{{ asset('assets/img/images.png') }}");
    });
</script>
