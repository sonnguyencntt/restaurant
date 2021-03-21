function callApi($url,$data)
{
   return $.ajax({
        url: $url,
        type: "POST",
        dataType: "JSON",
        data: $data
    });
}