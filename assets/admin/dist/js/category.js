
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
      func.ValidateId(["category_name", "active"], [], [], true)
      form.reset();
      return;
    }
    $("." + progress).css('width', width + "%");
    $("." + progress).text(width + "%");
  }
  $("#createForm").submit(function (e) {
  
  
    var form = this;
    
    e.preventDefault();
  
    if (func.ValidateId(["category_name", "active"], [], []) === true) {
      func.disableModalId("addModal");
      func.showElementId(['progress']);
      var percenTage = 0;
  
      setTimeout(() => {
        $(".progress-bar").css("width", percenTage + "%");
        $(".progress-bar").text(percenTage + "%");
      }, 500);
  
      callApi("?controller=category&type=admin&action=insert", { name: this.category_name.value, active: this.active.value }).done(function (data) {
        var timer = setInterval(function () {
          percenTage = percenTage + 25;
          IncreasePer("progress-bar", percenTage, timer, form,data)}
  , 500)
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
    $('.alert-remove').html("<p>Do you really want to remove category Id :  " + $id + "?</p>")
    $("[name = remove_id_category]").val($id);
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
    callApi("?controller=category&type=admin&action=delete", { id_category: form.remove_id_category.value }).done(function (data) {
  
      var timer = setInterval(function () {
        percenTage = percenTage + 25;
        IncreasePer_remove("progress-bar-remove", percenTage, timer,data, tr)
      }, 500)
  
  
  
    })
  
  })
  function editFunc($id, $tr) {
  
    $string = $tr;
    func.hideElementId(['edit_category_name', 'edit_active']);
  
    func.showElementId(['loader', 'loader1']);
    func.disableAttrId(["submit-edit"]);
  
  
    callApi("?controller=category&type=admin&action=edit", { id_category: $id }).done(function (data) {
      console.log(data);
      $("#edit_id_category").val(data.data[0].id_category);
      $("#edit_category_name").val(data.data[0].name);
      $("#edit_active").val(data.data[0].active);
  
  
        func.showElementId(['edit_category_name', 'edit_active']);
        func.hideElementId(['loader', 'loader1']);
        func.undisableAttrId(["submit-edit"]);
  
  
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
      func.ValidateId(["edit_category_name", "edit_active"], [], [], true)
      form.reset();
      return;
    }
    $("#" + progress).css('width', width + "%");
    $("#" + progress).text(width + "%");
  }
  
  $("#updateForm").submit(function(e) {
    var str = $string;
    delete($string);
  
    e.preventDefault();
    var form = this;
    if (func.ValidateId(["edit_category_name", "edit_active"], [], []) === true) {
      func.disableModalId("editModal");
      func.showElementId(['progress-edit']);
      var percenTage = 0;
  
      setTimeout(() => {
        $("#progress-bar-edit").css("width", percenTage + "%");
        $("#progress-bar-edit").text(percenTage + "%");
      }, 500);
  
  
  
      callApi("?controller=category&type=admin&action=update", { name: form.edit_category_name.value, active: form.edit_active.value , id_category : form.edit_id_category.value }).done(function (data) {
  
        var timer = setInterval(function () {
          percenTage = percenTage + 25;
          IncreasePer_edit("progress-bar-edit", percenTage, timer, form,data, str)
        }, 500)
      })
  
    }
  
  })
  