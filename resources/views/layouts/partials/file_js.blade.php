<script type="text/javascript">
    $('#table-user').DataTable({
        processing: true,
        serverSide: true,
        
        ajax: "{{ route('admin.manajemen_user.api')  }}",
        columns: [
            {data: 'id', name:'id'},
            {data: 'nm_satuan_kerja', name:'nm_satuan_kerja'},
            {data: 'nm_user', name:'nm_user'},
            {data: 'username', name:'username'},
            {data: 'foto', name:'foto'},
            {data: 'level', name:'level'},
            {data: 'created_at', name:'created_at'},
            {data: 'action', name:'action', orderable: false, searchable: false,}
        ]
    });
</script>