var phpurl="PhpFiles/statistic.php";
function load() {
    $.ajax({
        type:"post",
        url:phpurl,
        data:{totalDesigns:"totalDesigns"},
        success:function (response){
            response=JSON.parse(response);
            $("#totalDesigns").append("<h3 class='info text-bold-700'>"+response[0].nbr+"</h3>");
        }
    });
       /* $.ajax({
            type:"post",
            url:phpurl,
            data:{products:"products"},
            success:function (response){
                $("#allproduct").append("<h3 class='success text-bold-700'>"+JSON.parse(response)+"</h3>");
            }
            });
            $.ajax({
                type:"post",
                url:phpurl,
                data:{assign:"assign"},
                success:function (response){
                    response=JSON.parse(response);
                    $("#allassign").append("<h3 class='warning text-bold-700'>"+response.count+"</h3>");
                }
                });
                $.ajax({
                    type:"post",
                    url:phpurl,
                    data:{Location:"Location"},
                    success:function (response){
                        $.each( JSON.parse(response), function(key, val) {
                            if(val.nbr>0)
                            {
                                $("#tbodyS").append(`<tr id="${val.location_id}"><td>${val.location_name}</td><td>${val.nbr}</td></tr>`);

                            }
                            else{
                                $("#tbodyS").append(`<tr id="${val.location_id}"><td>${val.location_name}</td><td>0</td></tr>`);

                            }
                        });
                        }
                    });
                    $.ajax({
                        type:"post",
                        url:phpurl,
                        data:{Location1:"Location1"},
                        success:function (response){
                            $.each( JSON.parse(response), function(key, val) {
                            
                                if(val.nbrA!=null)
                                {
                                    $(`#${val.location_id}`).append("<td>"+val.nbrA+"</td>");

                                }else{
                                    $(`#${val.location_id}`).append("<td>0</td>");
                                }
                            });
                            }
                        });
            */        
                 

}

load();
