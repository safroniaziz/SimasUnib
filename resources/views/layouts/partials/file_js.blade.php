<script type="text/javascript">
    $('#table-user').DataTable({
        processing: true,
        serverSide: true,
        
        ajax: "{{ route('admin.manajemen_user.api')  }}",
        columns: [
            {data: 'rownum', name: 'rownum'},
            {data: 'nm_satuan_kerja', name:'nm_satuan_kerja'},
            {data: 'nm_user', name:'nm_user'},
            {data: 'username', name:'username'},
            {data: 'foto', name:'foto'},
            {data: 'level', name:'level'},
            {data: 'created_at', name:'created_at'},
            {data: 'action', name:'action', orderable: false, searchable: false,}
        ]
    });

    function formEditUser(id) {
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#modal-user form')[0].reset();
        $.ajax({
          url: "{{ url('admin/manajemen_user') }}" + '/' + id + "/edit",
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('#modal-user').modal('show');
            $('.modal-title').text('Edit User');
            $('#id').val(data.id);
            $('#id_satuan_kerja').val(data.id_satuan_kerja);
            $('#nm_user').val(data.nm_user);
            $('#username').val(data.username);
            $('#password').val(data.password);
            $('#level').val(data.level);
          },
          error : function() {
              alert("Nothing Data");
          }
        });
    }
    function deleteData(id){
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
            $.ajax({
                url : "{{ url('contact') }}" + '/' + id,
                type : "POST",
                data : {'_method' : 'DELETE', '_token' : csrf_token},
                success : function(data) {
                    table.ajax.reload();
                    swal({
                        title: 'Success!',
                        text: data.message,
                        type: 'success',
                        timer: '1500'
                    })
                },
                error : function () {
                    swal({
                        title: 'Oops...',
                        text: data.message,
                        type: 'error',
                        timer: '1500'
                    })
                }
            });
        });
    }

    $(function(){
        $('form-user form').validator().on('submit', function (e) {
            if (!e.isDefaultPrevented()){
                var id = $('#id').val();
                url = "{{ route('admin.manajemen_user.store') }}";
                $.ajax({
                    url : url,
                    data : $('modal-user form').serialize(),
                    success : function($data) {
                        $('modal-user').modal('hide');
                        $('table-user').DataTable().ajax.reload();
                        exit(); 
                    },
                    error : function(){
                        alert('Oops! Something Error!');
                    }
                });
                return false;
            }
        });
    });
</script>