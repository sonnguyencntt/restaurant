var func = {
    ValidateId: function (arrayExsist, arrayEmail, arrayPhone, reset) {
        var result = true;
        if (typeof arrayEmail !== 'undefined' && arrayEmail.length > 0) {
            var eml_reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

            arrayEmail.forEach(data => {
                if (eml_reg.test($.trim($("#" + data).val())) == true) {
                    if (typeof reset !== 'undefined' && reset == true) {
                        $("#" + data).parent().removeClass('has-success');
                    }
                    else {
                        $("#" + data).parent().removeClass('has-error').addClass('has-success');
                    }
                    $("#err_" + data).addClass('hide-elm').removeClass('show-elm');
                }
                else {
                    $("#" + data).parent().addClass('has-error');
                    $("#err_" + data).removeClass('hide-elm').addClass('show-elm').text("Email không đúng định dạng");
                    result = false;
                }
            })
        }
        if (typeof arrayPhone !== 'undefined' && arrayPhone.length > 0) {
            var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
            arrayPhone.forEach(data => {
                if (vnf_regex.test($.trim($("#" + data).val())) == true) {
                    if (typeof reset !== 'undefined' && reset == true) {
                        $("#" + data).parent().removeClass('has-success');
                    }
                    else {
                        $("#" + data).parent().removeClass('has-error').addClass('has-success');
                    }
                    $("#err_" + data).addClass('hide-elm').removeClass('show-elm');
                }
                else {
                    $("#" + data).parent().addClass('has-error');
                    $("#err_" + data).removeClass('hide-elm').addClass('show-elm').text("Số điện thoại không đúng định dạng");
                    result = false;
                }
            })
        }
        if (typeof arrayExsist !== 'undefined' && arrayExsist.length > 0) {
            arrayExsist.forEach(data => {
                if(typeof $('#' + data).attr('title') != "undefined") return;
                if ($('#' + data).attr('type') == "file") {
                    
                    if ($('#' + data).get(0).files.length === 0) {
                        $("#" + data).parent().addClass('has-error');
                        $("#err_" + data).removeClass('hide-elm').addClass('show-elm').text('Chưa chọn hình ảnh');
                        result = false;
                    }
                    else
                    {
                        if (typeof reset !== 'undefined' && reset == true) {
                            $("#" + data).parent().removeClass('has-success');
                        }
                        else {
                            $("#" + data).parent().removeClass('has-error').addClass('has-success');
                        }
                        $("#err_" + data).addClass('hide-elm').removeClass('show-elm');

                    }
                    return;
                }
                if (data == "setting_password" || data == "setting_cpassword") {
                    if ($("#" + data).val().replace(/\s+/g, '').length == 0) { }
                    else {
                        if ($.trim($("#setting_password").val()) != $.trim($("#setting_cpassword").val())) {
                            $("#" + data).parent().addClass('has-error');
                            $("#err_" + data).removeClass('hide-elm').addClass('show-elm').text('Nhập lại mật khẩu không đúng');
                            result = false;
                        }
                        else {
                            if (typeof reset !== 'undefined' && reset == true) {
                                $("#" + data).parent().removeClass('has-success');
                            }
                            else {
                                $("#" + data).parent().removeClass('has-error').addClass('has-success');
                            }
                            $("#err_" + data).addClass('hide-elm').removeClass('show-elm');
                        }
                    }

                }
                else if ((data == "password" || data == "cpassword") && $("#" + data).val().replace(/\s+/g, '').length > 0) {


                    if ($.trim($("#password").val()) != $.trim($("#cpassword").val())) {
                        $("#" + data).parent().addClass('has-error');
                        $("#err_" + data).removeClass('hide-elm').addClass('show-elm').text('Nhập lại mật khẩu không đúng');
                        result = false;
                    }
                    else {
                        if (typeof reset !== 'undefined' && reset == true) {
                            $("#" + data).parent().removeClass('has-success');
                        }
                        else {
                            $("#" + data).parent().removeClass('has-error').addClass('has-success');
                        }
                        $("#err_" + data).addClass('hide-elm').removeClass('show-elm');
                    }

                }
                else if ((data == "edit_password" || data == "edit_cpassword")) {


                    if ($.trim($("#edit_password").val()) != $.trim($("#edit_cpassword").val())) {
                        $("#" + data).parent().addClass('has-error');
                        $("#err_" + data).removeClass('hide-elm').addClass('show-elm').text('Nhập lại mật khẩu không đúng');
                        result = false;
                    }
                    else {
                        if (typeof reset !== 'undefined' && reset == true) {
                            $("#" + data).parent().removeClass('has-success');
                        }
                        else {
                            $("#" + data).parent().removeClass('has-error').addClass('has-success');
                        }
                        $("#err_" + data).addClass('hide-elm').removeClass('show-elm');
                    }

                }

                else if ($('#' + data).attr('type') == "radio") {
                    var checkedValue = $('.' + data + ':checked').val();
                    if (typeof checkedValue == "undefined") {
                        $("#" + data).parent().parent().addClass('has-error');
                        $("#err_" + data).removeClass('hide-elm').addClass('show-elm').text('Dữ liệu không được để trống');
                        result = false;
                    }
                    else {

                        if (typeof reset !== 'undefined' && reset == true) {
                            $("#" + data).parent().parent().removeClass('has-success');
                        }
                        else {
                            $("#" + data).parent().parent().removeClass('has-error').addClass('has-success');
                        }
                        $("#err_" + data).addClass('hide-elm').removeClass('show-elm');
                    }
                }
                else {
                    if ((($.trim($("#" + data).val())).replace(/\s+/g, '')).length == 0) {
                        $("#" + data).parent().addClass('has-error');
                        $("#err_" + data).removeClass('hide-elm').addClass('show-elm').text('Dữ liệu không được để trống');
                        result = false;
                    }
                    else {
                        if (typeof reset !== 'undefined' && reset == true) {
                            $("#" + data).parent().removeClass('has-success');
                        }
                        else {
                            $("#" + data).parent().removeClass('has-error').addClass('has-success');
                        }
                        $("#err_" + data).addClass('hide-elm').removeClass('show-elm');
                    }
                }

            });
        }
        return result;
    },
    resetError: function (form) {
        form.reset();
    },
    disableAttrId: function (arrayAttr) {
        if (typeof arrayAttr !== "undefined" && arrayAttr.length > 0) {
            arrayAttr.forEach(data => {
                $("#" + data).attr('disabled', 'disabled').css("cursor", "no-drop");
            })
        }
    },
    undisableAttrId: function (arrayAttr) {
        if (typeof arrayAttr !== "undefined" && arrayAttr.length > 0) {
            arrayAttr.forEach(data => {
                $("#" + data).attr('disabled', false).css("cursor", "unset");;
            })
        }
    },
    showElementId: function (arrayElemnt) {
        if (typeof arrayElemnt !== "undefined" && arrayElemnt.length > 0) {
            arrayElemnt.forEach(data => {
                $("#" + data).addClass('show-elm').removeClass('hide-elm');
            })
        }
    },
    showElementClass: function (arrayElemnt) {
        if (typeof arrayElemnt !== "undefined" && arrayElemnt.length > 0) {
            arrayElemnt.forEach(data => {
                $("." + data).addClass('show-elm').removeClass('hide-elm');
            })
        }
    },
    hideElementId: function (arrayElemnt) {
        if (typeof arrayElemnt !== "undefined" && arrayElemnt.length > 0) {
            arrayElemnt.forEach(data => {
                $("#" + data).addClass('hide-elm').removeClass('show-elm');

            })
        }
    },
    hideElementClass: function (arrayElemnt) {
        if (typeof arrayElemnt !== "undefined" && arrayElemnt.length > 0) {
            arrayElemnt.forEach(data => {
                $("." + data).addClass('hide-elm').removeClass('show-elm');

            })
        }
    },
    setProgressBarId: function (id, percentage) {
        $('#' + id).css('width', percentage + '%')
    },
    disableModalId: function ($id) {
        $("#" + $id).find(":input,:button").attr("disabled", "disabled").css("cursor", "no-drop");

    },
    undisableModalId: function ($id) {
        $("#" + $id).find(":input,:button").attr("disabled", false).css("cursor", "unset");

    }
}
