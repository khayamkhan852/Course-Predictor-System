<script>
    $(document).ready(function (){
        $('#customers').DataTable({
                "autoWidth": true,
                "responsive": true,
                "scrollX": true,
                "columnDefs": [
                    { className: "dt-nowrap", "targets": [ 0,1,2,3,4,5,6,7,8,9,10,11,12 ] }
                ],
            });
    });
</script>