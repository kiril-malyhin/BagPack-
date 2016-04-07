var app = angular.module("myApp", ["ui.router",'ui.bootstrap','Alertify','ngRoute']);

    $(".CheckBoxClass").change(function(){
        if($(this).is(":checked")){
            $(this).next("label").addClass("LabelSelected");
        }else{
            $(this).next("label").removeClass("LabelSelected");
        }
    });
    $(".RadioClass").change(function(){
        if($(this).is(":checked")){
            $(".RadioSelected:not(:checked)").removeClass("RadioSelected");
            $(this).next("label").addClass("RadioSelected");
        }
    });

    $(function () {
        $("[data-toggle = 'tooltip']").tooltip();
    });



















