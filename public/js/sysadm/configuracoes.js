$(document).ready(function(){
    $(".fas.fa-plus").click(function (){
        $(".loaded").fadeOut(0);
        $.ajax({
            type: "POST",
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
                        showToast(obj.msg);
                    }
                }
                catch(e)
                {
                    console.log(e);
                    showToast("Erro ao criar backup");
                }
            }
        });
    });
    $(".fas.fa-file-archive").click(function (){

    });
});