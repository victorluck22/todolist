

$(function () {
    var table = $('#tasks_main').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('Home') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
        ]
    });
  });
