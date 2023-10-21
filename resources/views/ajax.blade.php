<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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
            console.log(title,is_active);

            $.ajax({
                // url: '/add',
                url:"{{ route('add.list') }}",
                method: 'POST',
                data: {
                    title,
                    is_active
                },
                success: function(res) {
                    if(res.status=='success'){
                        $('#addmodal').modal('hide');
                        $('#add')[0].reset();
                        $('.table').load(location.href+' .table');
                    }
                    // $('#todo_modal').modal('hide')
                    // $('#title').val('')
                    // getData();
                },
                error: function(err) {
               
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">'+value + '</span>');


                    });
                }
            })

        })
    });
</script>
