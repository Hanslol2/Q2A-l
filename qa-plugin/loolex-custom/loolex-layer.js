$(document).ready(function(){
    var form = document.getElementsByName("ask");
    $(form).submit(function(event){ //action when login form was submitted	
        var Category = $("input[name=cat]").val();	//get loolex-id 
        $.ajax({	
            type: 'post',
            dataType: 'json',
            url: '/q2a_1-8/qa-plugin/loolex-custom/loolex-exec.php', 
            data: { cat : Category },
            success: function (data){
                $("input[name=catID]").val(data);
            },
            error: function(data){
                console.debug(data);
                console.log(data);
                alert("failure");
            }
        });
    });
});