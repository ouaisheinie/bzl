window.onload = function(){
    btn4s();
        $(".header_name").click(function(){
           $("#body_shade").show();
           funShowDivCenter("#div_show_main");
        });
    $(".show_main_header span").click(function(){
        $("#body_shade").hide();
        $("#div_show_main").hide();
    });
    mainShadeH();
}
function btn4s(){
    $(".btn_main button").click(function(){
        $(this).css("color","#ed5854");
        $(this).parents().siblings().children().css("color","#000");

        $(".tickts_list_d").hide();
        $('.'+$(this).attr("name")).show();
    });
}
function funShowDivCenter(div) {
    var top = ($(window).height() - $(div).height()) / 2;
    var left = ($(window).width() - $(div).width()) / 2;
    var scrollTop = $(document).scrollTop();
    var scrollLeft = $(document).scrollLeft();
    $(div).css({ position: 'absolute', 'top': top + scrollTop, left: left + scrollLeft }).show();
}
function mainShadeH(){
    $("#body_shade").height($("body").height());
}