$(document).ready(function(){
    $(".fas.fa-plus").click(function (){
        $(".loaded").fadeOut(0);
        $.ajax({
            type: "GET",
            url: document.location.origin + '/receitasOn/public/sysadm/configuracoes' + '/backup',
            beforeSend: function (){
                $(".loading").fadeIn();$(".loading").css('display','felx');
            },
            success: function (ret){
                console.log(ret);
                console.log(ret.result);
                try
                {
                    var obj = JSON.parse(ret);
                    console.log(obj);
                    console.log(obj.result);
                    if(obj.result == true)
                    {
                        $(".loading").fadeOut(0);
                        $(".loaded").fadeIn();$(".loaded").css('display','felx');
                        $('.back').append("<div class='item'><div class='icon'><i class='far fa-file' aria-hidden='true'></i></div><div class='nome'><p>"+ obj.backup +"</p></div></div>");
                        showToast(obj.msg);
                    }
                    else
                    {
                        $(".loading").fadeOut(0);
                        showToast(obj.msg);
                    }
                }
                catch(e)
                {
                    //console.log(e);
                    $(".loading").fadeOut(0);
                    showToast("Erro ao criar backup");
                }
            }
        });
    });
    $(".fas.fa-file-archive").click(function (){
        $(".loaded").fadeOut(0);
        $.ajax({
            type: "GET",
            url: document.location.origin + '/receitasOn/public/sysadm/configuracoes' + '/zip',
            beforeSend: function (){
                $(".loading").fadeIn();
                $(".loading").css('display','felx');
            },
            success: function (ret){
                console.log(ret);
                console.log(ret.result);
                try
                {
                    var obj = JSON.parse(ret);
                    console.log(obj);
                    console.log(obj.result);
                    if(obj.result == true)
                    {
                       
                        $(".loading").fadeOut(0);
                        $(".loaded").fadeIn();$(".loaded").css('display','felx');
                        $('.back').append("<div class='item'><div class='icon'><i class='far fa-file-archive' aria-hidden='true'></i></div><div class='nome'><p>"+ obj.zip +"</p></div></div>");
                        $('.sql').remove();
                        showToast(obj.msg);
                    }
                    else
                    {
                        $(".loading").fadeOut(0);
                        showToast(obj.msg);
                    }
                }
                catch(e)
                {
                    //console.log(e);
                    $(".loading").fadeOut(0);
                    showToast("Erro ao criar zip");
                }
            }
        });
    });
});