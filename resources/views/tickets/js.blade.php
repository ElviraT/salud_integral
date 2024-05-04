<script>
    $(document).on('show.bs.modal', '#add_ticket', function(e) {
        $('#due_date').datetimepicker({
            useCurrent: false,
            format: 'DD-MM-YYYY',
            debug: true,
        })
    })
</script>
