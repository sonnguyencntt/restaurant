var t = $('#manageTable').DataTable({
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
  $(".select_group").select2();
  var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
   'onclick="alert(\'Call your custom code here.\')">' +
   '<i class="glyphicon glyphicon-tag"></i>' +
   '</button>'; 
     $("[name=product_image]").fileinput({
   overwriteInitial: true,
   maxFileSize: 1500,
   showClose: false,
   showCaption: false,
   browseLabel: '',
   removeLabel: '',
   browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
   removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
   removeTitle: 'Cancel or reset changes',
   elErrorContainer: '#kv-avatar-errors-1',
   msgErrorClass: 'alert alert-block alert-danger',
   // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
   layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
   allowedFileExtensions: ["jpg", "png", "gif", "txt"]
  });
  
  function validate()
  {
    if (func.ValidateId(["groups", "store" ,"username","password","cpassword","fname","lname","phone","male"], ["email"], []) === true) {
      return true
  }

  return false;}
  function removeFunc($id) {
    $('.alert-remove').html("<p>Do you really want to remove User Id :  " + $id + "?</p>")
    $("[name = remove_id_product]").val($id);
  }

  function validate_update(){
    if(func.ValidateId(["edit_groups", "edit_store" ,"edit_username","edit_password","edit_cpassword","edit_fname","edit_lname","edit_phone","edit_male"], ["edit_email"], []) === true){
      return true;
    }
    return false;
  }