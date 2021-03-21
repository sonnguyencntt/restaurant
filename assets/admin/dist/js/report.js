$("[name = select_store]").change(function(){
    var id = this.value;
    $("[name = select_year]").html('<option value="" selected>---Loading---</option>')
    callApi("?controller=report&type=admin&action=selectdate", {id: id}).done(function (data) {
       var html = '';
       var select = ''
        if(data.status)
       {
        html = '<option value="">Select year</option>';

           (data.data).forEach(function(item,index){
            {
                if(index == 0)
                    select = 'selected'
                else
                    select = '';
                html +='<option value="'+item+'" '+select+'>'+item+'</option>';
            }
           })
          
       }
       else
           html = '<option value="" selected>Không có dữ liệu</option>';
           $("[name = select_year]").html(html)

      })
})