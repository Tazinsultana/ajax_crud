<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.add_lst', function(e) {

            e.preventDefault();
            // For Creating....
            let title = $('#title').val();
            let is_active = $('#is_active').is(":checked");
            // console.log(title, is_active);

            $.ajax({
               
                url: "{{ route('add.list') }}",
                method: 'POST',
                data: {
                    title,
                    is_active
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $('#addmodal').modal('hide');
                        $('#add')[0].reset();
                        $('.table').load(location.href + ' .table');
                    }
                    // $('#todo_modal').modal('hide')
                    // $('#title').val('')
                    // getData();
                },
                error: function(err) {

                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">' +
                            value + '</span>');


                    });
                }
            })

        })


        // show update form

        $(document).on('click', '.upate_modal_form', function() {
            let id = $(this).data('id');
            console.log(id);
          
            $.ajax({

            url:"{{ route('edit.list') }}",
            method:"GeT",
            data:{id},
            success:function(res){

            $('#up_id').val(res.data.id);
            $('#up_title').val(res.data.title);

            if(res.data.is_active){
                $('#up_is_active').prop('checked',true);

            }
            else{
                $('#up_is_active').prop('checked',false);
            }
            
                // console.log(res);
            }

           })
            
        });

        // update list

        $(document).on('click', '.up_lst', function(e) {

            e.preventDefault();

            let up_id=$('#up_id').val();
            let up_title = $('#up_title').val();
            let up_is_active = $('#up_is_active').is(":checked");
            // console.log(title, is_active);

            $.ajax({

                url: "{{ route('update.list') }}",
                method: 'PUT',
                data: {
                    id:up_id,
                   title: up_title,
                    is_active:up_is_active
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $('#updatemodal').modal('hide');
                        $('#update')[0].reset();
                        $('.table').load(location.href + ' .table');
                    }

                },
                error: function(err) {

                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">' +
                            value + '</span>');


                    });
                }
            })

        })

        // delete list

        $(document).on('click', '.delete_modal', function(e) {

            e.preventDefault();

            let del_id = $(this).data('id');
            // alert(del_id);
            if (confirm('Are you sure to delte list??')) {

                $.ajax({

                    //    url: '/delete/'+id,
                    
                    url: "{{ route('delete.list') }}",
                    method: 'DELETE',
                    data: { del_id},
                        
                  
                    success: function(res) {
                        if (res.status == 'success') {

                            $('.table').load(location.href + ' .table');
                        }

                    }

                })

            }

            // console.log(title, is_active)


        })
    });
</script>
