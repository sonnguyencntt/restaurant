
var t = $('#userTable').DataTable({
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
  function IncreasePer(progress, width, timer, form, data) {
    if (width > 100) {
      var action =  data.status ? "success" : "danger";
      clearInterval(timer);
      func.undisableModalId("addModal");
      func.hideElementId(['progress']);
      $("." + progress).css('width', "0%");
      $("." + progress).text("0%");
      $("#addModal").modal('hide'); 
      if(data.status == true)
      {
        t.row.add(data.data).draw(true);
      }
  
      $("#messages").html('<div class="alert alert-' + action+ ' alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + data.message + '</div>')
      func.ValidateId(["groups", "store" ,"username","password","cpassword","fname","lname","phone","male"], ["email"], [], true);
      form.reset();
      return;
    }
    $("." + progress).css('width', width + "%");
    $("." + progress).text(width + "%");
  }
  $("#createForm").submit(function (e) {
  
    var form = this;
    var data = $(this).serialize();
    
    e.preventDefault();
  
    if (func.ValidateId(["groups", "store" ,"username","password","cpassword","fname","lname","phone","male"], ["email"], []) === true) {

        
      func.disableModalId("addModal");
      func.showElementId(['progress']);
      var percenTage = 0;
  
      setTimeout(() => {
        $(".progress-bar").css("width", percenTage + "%");
        $(".progress-bar").text(percenTage + "%");
      }, 500);
    
      callApi("?controller=user&type=admin&action=insert",data).done(function (data) {
        var timer = setInterval(function () {
          percenTage = percenTage + 25;
          IncreasePer("progress-bar", percenTage, timer, form,data)}
  , 500)
      }).catch(function(err){
        console.log(err)
      })
    }
  })
  
  function IncreasePer_remove(progress, width, timer, data, form) {
  
    if (width > 100) {
      clearInterval(timer);
      func.undisableModalId("removeModal");
      func.hideElementId(['progress-remove']);
      $("#" + progress).css('width', "0%");
      $("#" + progress).text("0%");
      $("#removeModal").modal('hide');
      var action =  data.status ? "success" : "danger";
  
  
      $("#messages").html('<div class="alert alert-' + action + ' alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + data.message + '</div>');
      if(data.status)
      {
        t.row($(form).parents('tr')).remove().draw();
  
      }
      return;
    }
    $("#" + progress).css('width', width + "%");
    $("#" + progress).text(width + "%");
  }
  
  function removeFunc($id, $tr) {
    $('.alert-remove').html("<p>Do you really want to remove User Id :  " + $id + "?</p>")
    $("[name = remove_id_user]").val($id);
    $string = $tr
  }
  $("#removeForm").submit(function (e) {
    var tr = $string;
    delete($string);
    e.preventDefault();
    func.disableModalId("removeModal");
    func.showElementId(['progress-remove']);
    var percenTage = 0;
    var form = this;
    setTimeout(() => {
      $(".progress-bar-remove").css("width", percenTage + "%");
      $(".progress-bar-remove").text(percenTage + "%");
    }, 500);
    callApi("?controller=user&type=admin&action=delete", { id_user: form.remove_id_user.value }).done(function (data) {
      console.log(data);
      var timer = setInterval(function () {
        percenTage = percenTage + 25;
        IncreasePer_remove("progress-bar-remove", percenTage, timer,data, tr)
      }, 500)
  
  
  
    }).catch(function(err){
      console.log(err);
    })
  
  })
  function editFunc($id, $tr) {
  
    $string = $tr;
    func.hideElementId(["edit_groups", "edit_store" ,"edit_username","edit_password","edit_cpassword","edit_fname","edit_lname","edit_phone","edit_email","edit_radio"])

   
    func.showElementClass(['loader']);
  
  
    callApi("?controller=user&type=admin&action=edit", { id_user: $id }).done(function (data) {
      console.log(data);
      $("#edit_id_user").val($id);

      $("#edit_groups").val(data.data[0].table_group.id);
      $("#edit_store").val("2");
      $("#edit_username").val(data.data[0].username);
     
      $("#edit_fname").val(data.data[0].fristname);
      $("#edit_lname").val(data.data[0].lastname);
      $("#edit_phone").val(data.data[0].phone);
      $("#edit_email").val(data.data[0].email);
      $('input:radio[name="edit_gender"]').filter('[value="'+data.data[0].gender+'"]').attr('checked', true);
  
  
        func.showElementId(["edit_groups", "edit_store" ,"edit_username","edit_password","edit_cpassword","edit_fname","edit_lname","edit_phone","edit_email","edit_radio"]);
        func.hideElementClass(['loader']);
        func.undisableAttrId(["submit-edit"]);
  
  
    }).catch(function(err){
      console.log(err);
    })
  
  }
  
  
  
  //////////////////////////////////////
  function IncreasePer_edit(progress, width, timer, form, data , str) {
    if (width > 100) {
      clearInterval(timer);
      func.undisableModalId("editModal");
      func.hideElementId(['progress-edit']);
      $("#" + progress).css('width', "0%");
      $("#" + progress).text("0%");
      $("#editModal").modal('hide');
      if(data.status)
      {
        t.row($(str).parents('tr')).data(data.data).invalidate();;
  
      }
      var action =  data.status ? "success" : "danger";
  
     
      $("#messages").html('<div class="alert alert-' + action + ' alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + data.message + '</div>')
      func.ValidateId(["edit_store_name", "edit_active"], [], [], true)
      form.reset();
      return;
    }
    $("#" + progress).css('width', width + "%");
    $("#" + progress).text(width + "%");
  }
  
  $("#updateForm").submit(function(e) {
   

    e.preventDefault();
    if (func.ValidateId(["edit_groups", "edit_store" ,"edit_username","edit_password","edit_cpassword","edit_fname","edit_lname","edit_phone","edit_male"], ["edit_email"], []) === true) {
      var str = $string;
      delete($string);
      var data = $(this).serialize();
      var form = this;
      func.disableModalId("editModal");
      func.showElementId(['progress-edit']);
      var percenTage = 0;
  
      setTimeout(() => {
        $("#progress-bar-edit").css("width", percenTage + "%");
        $("#progress-bar-edit").text(percenTage + "%");
      }, 500);
  
  
  
      callApi("?controller=user&type=admin&action=update", data).done(function (data) {
  
        var timer = setInterval(function () {
          percenTage = percenTage + 25;
          IncreasePer_edit("progress-bar-edit", percenTage, timer, form,data, str)
        }, 500)
      }).catch(function(err){
        console.log(err);
      })
  
    }
  
  })
  