window.onload = function(){
    QRCode_show("button1");
    QRCode_show("button2");
    // showShade();
    // showFalse();
}
function QRCode_show(btn_r){
    var btn1 = document.getElementById(btn_r);
    btn1.onclick = function(){
        var QRCode = document.getElementById(this.name);
        var images = document.querySelectorAll(".qrcode");
        var btn = document.querySelectorAll(".buy_detailes ul li:nth-child(4) button");
        for(var j=0;j<btn.length;j++){
            btn[j].style.border="1px solid #cccccc";
        }
        btn1.style.border="1px solid #fe0000";
        btn1.style.color="1px solid #fe0000";
        for(var i=0;i<images.length;i++){
            images[i].style.display="none";
        }
        QRCode.style.display = "block";
    }
}

function funShowDivCenter(div){
    var top = ($(window).height() - $(div).height()) / 2;
    var left = ($(window).width() - $(div).width()) / 2;
    var scrollTop = $(document).scrollTop();
    var scrollLeft = $(document).scrollLeft();
    $(div).css({ position: 'absolute', 'top': top + scrollTop, left: left + scrollLeft }).show();
}
function showShade(){
    //这里的事件绑定给h3的  
    // var btn1 = document.querySelector(".title1"); 先注释掉
    var middleshow = document.querySelector("#div_show");
    var close_shade = document.querySelector(".show_header icon");
    var shade = document.querySelector('#divShade');
    btn1.onclick = function(){
        shade.style.display="block";
        funShowDivCenter(middleshow);
    }
    close_shade.onclick = function(){
        shade.style.display="none";
        middleshow.style.display = "none";
    }
}
function showFalse(){
    //也绑定在h3上 后面再用
    // var btn1 = document.querySelector(".title1");
    var middleshow = document.querySelector("#false_div");
    var close_shade = document.querySelectorAll(".show_header icon")[1];
    var shade = document.querySelector('#divShade');
    btn1.onclick = function(){
        shade.style.display="block";
        funShowDivCenter(middleshow);
    }
    close_shade.onclick = function(){
        shade.style.display="none";
        middleshow.style.display = "none";
    }
}