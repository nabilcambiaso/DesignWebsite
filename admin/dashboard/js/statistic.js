var phpurl = "PhpFiles/statistic.php";
function load() {
    $.ajax({
        type: "post",
        url: phpurl,
        data: { totalDesigns: "totalDesigns" },
        success: function (response) {
            response = JSON.parse(response);
            $("#totalDesigns").append("<h3 class='info text-bold-700'>" + response[0].nbr + "</h3>");
        }
    });
    //total products
    $.ajax({
        type: "post",
        url: phpurl,
        data: { totalProducts: "totalProducts" },
        success: function (response) {
            response = JSON.parse(response);
            $("#totalProducts").append("<h3 class='info text-bold-700'>" + response[0].nbr + "</h3>");
        }
    });
    //total Messages
   totalMessages();


    //load messages
    getMessagesButtons();
    setInterval(() => {
    getMessagesButtons();
    }, 20000);

    

   
    /* 
        
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
function  totalMessages() { 
    $.ajax({
        type: "post",
        url: phpurl,
        data: { totalMessages: "totalMessages" },
        success: function (response) {
            response = JSON.parse(response);
            $("#totalMessages").html("<h3 class='info text-bold-700'>" + response[1][0].nbr + "/" + response[0][0].nbr + "</h3>");
        }
    });
 }

function getMessagesButtons()
    {
        $("#tbodyMessagesButtons").html("");
        $.ajax({
            type: "post",
            url: phpurl,
            data: { loadMessages: "loadMessages" },
            success: function (response) {
                response = JSON.parse(response);
                $.each(response, function (key, val) {
                    if (val.seen == 0) {
                        $("#tbodyMessagesButtons").append(
                            `
                            <tr>
                            <td class="text-center"><button onclick="loadMessage(${val.idMessages})" class="btn btn-blue" style="width:200px; padding:0px 30px;">${val.name}</button>
                                  &nbsp;<span style="font-size:smaller;" class=" h6 text-xs-center text-gray-dark ">${val.date}</span>  
                                    </td></tr>
                            `
                        );
                    } else {

                        $("#tbodyMessagesButtons").append(
                            `
                                <tr>
                                <td class="text-center"><button onclick="loadMessage(${val.idMessages})" class="btn btn-gray" style="width:200px;background-color:gray; color:white; padding:0px 30px;">${val.name}</button>
                                      &nbsp;<span style="font-size:smaller ; color:grey;" class=" h6 text-xs-center  ">${val.date}</span>  
                                        </td></tr>
                                `
                        );

                    }

                });

                console.log(response);
            }
        });
    }

async function loadMessage(idMessage) {
    await $.ajax({
        type: "post",
        url: phpurl,
        data: {
            idMessage: idMessage
        },
        success: function (response) {
            response = JSON.parse(response);
            $.each(response, function (key, val) {

                $("#tbodyTheMessage").html(
                    `
                            <tr>
                            <td colspan="2"><span class="h4 text-success text-center text-lg-left" > Name: </span> 
                            <span class="h5 text-center text-black-50 text-lg-left" >${val.name}</span></td>   
                        </tr>
                        <tr>
                            <td colspan="2"><span class="h4 text-success text-center text-lg-left" > Email Adress: </span> 
                            <span class="h5 text-center text-black-50 text-lg-left" >${val.email}</span></td>   
                        </tr>
                        <tr>
                            <td colspan="2"><span class="h4 text-success text-center text-lg-left" > Subject: </span> 
                            <span class="h5 text-center text-black-50 text-lg-left" >${val.subject}</span></td>   
                        </tr>
                        <tr>
                            <td colspan="2"><span class="h4 text-success text-center text-lg-left" > Url: </span> 
                            <span class="h5 text-center text-black-50 text-lg-left" ><a href="${val.url}" target="_blank">Specific Item</a></span></td>   
                        </tr>
                        <tr>
                            <td colspan="2"><span class="h4 text-success text-center text-lg-left" > Message: </span> 
                            <span class="h5 text-center text-black-50 text-lg-left" >${val.message}</span></td>   
                        </tr>
                            `
                );



            });
        }
    });
    await getMessagesButtons();
    await totalMessages();
}
