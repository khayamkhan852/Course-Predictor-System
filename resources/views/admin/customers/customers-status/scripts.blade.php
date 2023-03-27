<script>
    $(document).ready(function(){

        $('#customer_status_list').DataTable({
            "ajax": {
            'url': '{{ route('admin.operations.customers.status.show') }}',
            'type': 'GET',
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'status', name: 'status'},
                {data: 'created_by', name: 'created_by'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action'},
            ],
        });

    });

    // Add Customer status
    $('#add_customer_status_form').submit(function(event)
        {
            event.preventDefault();
            var form = $('#add_customer_status_form')[0];
            var formData = new FormData(form);
            $.ajax({
                url : '{{ route('admin.operations.customers.status.store') }}',
                type : 'POST',
                data : formData,
                contentType : false,
                processData : false,

                success : function(data){
                    $('#add_customer_status_modal').modal('hide');
                    onSuccessRemoveErrors();
                    Swal.fire({
                        icon: 'success',
                        text: 'Added Successfully!',
                    })
                    $('#customer_status_list').DataTable().ajax.reload();
                },

                error : function(reject){
                    if(reject.status = 422){
                        refreshErrors();
                        var errors = $.parseJSON(reject.responseText);
                        $.each(errors.errors, function(key, value){
                            console.log(key);
                            $('#'+key).addClass('is-invalid');
                            $('#'+key+'_help').text(value[0]);
                        });
                    }
                }
            });
        });

        function onSuccessRemoveErrors(){
            $('#status').removeClass('is-invalid');
            $('#status').val('');
            $('#status_help').text('');
        }

        function refreshErrors(){
            $('#status').removeClass('is-invalid');
            $('#status_help').text('');
        }

        $('#add_customer_status_modal').on('hidden.bs.modal', function(){
            onSuccessRemoveErrors();
        });

    // Edit Customer status
    $(document).on('click', '#editCustomerStatus', function(e){
        e.preventDefault();
            var id = $(this).attr('data-id');
            let a = '{{ route('admin.operations.customers.status.edit','id')}}';
            var url = a.replace('id',id);
            $.ajax({
                url : url,
                type : 'GET',
                data : id,
                contentType : false,
                processData : false,

                success : function(data){
                    $('#customer_status_id').val(data.id);
                    $('#edit_status').val(data.status);
                    $('#edit_customer_status_modal').modal('show');
                },
            });
    });

    // Update Customer status
    $('#edit_customer_status_form').submit(function(event){
        event.preventDefault();
        var form = $('#edit_customer_status_form')[0];
        var formData = new FormData(form);

        $.ajax({
            url : '{{ route('admin.operations.customers.status.update') }}',
            type : 'POST',
            data : formData,
            contentType : false,
            processData : false,

            success : function(data){
                $('#edit_customer_status_modal').modal('hide');
                onSuccessRemoveEditErrors();
                Swal.fire({
                    icon: 'success',
                    text: 'Updated Successfully!',
                })
                $('#customer_status_list').DataTable().ajax.reload();
            },

            error : function(reject){
                if(reject.status = 422){
                    refreshEditErrors();
                    var errors = $.parseJSON(reject.responseText);
                    $.each(errors.errors, function(key, value){
                        $('#'+key).addClass('is-invalid');
                        $('#'+key+'_help').text(value[0]);
                    });
                    }
            }
        });
    });


    function onSuccessRemoveEditErrors(){
        $('#edit_status').removeClass('is-invalid');
        $('#edit_status').val('');
        $('#edit_status_help').text('');
    }

    function refreshEditErrors(){
        $('#edit_status').removeClass('is-invalid');
        $('#edit_status_help').text('');
    }

    $('#edit_customer_status_modal').on('hidden.bs.modal', function(){
        onSuccessRemoveEditErrors();
    });

    // Delete
    $(document).on('click', '#deleteCustomerStatus', function(e){
            e.preventDefault();
            var id = $(this).attr('data-id');
            let a = '{{ route("admin.operations.customers.status.delete","id")}}';
            var url = a.replace('id',id);
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
          })
                .then((result) =>
            {
              if (result.isConfirmed) {
                $.ajax({
                    url : url,
                    type : 'GET',
                    data : id,
                    contentType : false,
                    processData : false,

                    success : function(data){
                        Swal.fire(
                          'Deleted!',
                          'Deleted Successfully.',
                          'success'
                          );
                        $('#customer_status_list').DataTable().ajax.reload();
                    },

                    error: function(data,textStatus,xhr){
                        Swal.fire({
                          title: 'Error',
                          icon: 'warning',
                          text: 'Opps! Something Went Wrong. Try Again Lator!',
                        })
                    }
                });
            }
        });
    });


</script>
