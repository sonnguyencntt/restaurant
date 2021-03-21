var t = $('#groupTable').DataTable({
    "columnDefs": [{
      "searchable": false,
      "orderable": false,
      "targets": 0
    }],
    "order": [[1, 'desc']]
  });
  t.on('order.dt search.dt', function () {
    t.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
      cell.innerHTML = i + 1;
    });
  }).draw();

  function removeFunc($id) {
    $('.alert-remove').html("<p>Do you really want to remove User Id :  " + $id + "?</p>")
    $("[name = remove_id_group]").val($id);
  }