window.onload = function(){
    buyNow();
    closeDetails();
    buyNow2();
    closeDetails2();
    borderadd(".pro1S");
    borderadd(".pro2S");
    addNum(".addB1",".reduceB1",".sum_1");
    addNum(".addB2",".reduceB2",".sum_2");
}
function buyNow(){
    var buyN = document.querySelector("#buy_now1"),
    details = document.querySelector(".pro_details"),
    message = document.querySelector(".phone_message");
    buyN.onclick = function(){
        message.style.display = "none";
        details.style.display = "block";
    }
}
function closeDetails(){
    var close = document.querySelector(".close_details"),
    details = document.querySelector(".pro_details"),
    message = document.querySelector(".phone_message");
    close.onclick = function(){
        message.style.display = "block";
        details.style.display = "none";
    }
}
function buyNow2(){
    var buyN2 = document.querySelector("#buy_now2"),
    details = document.querySelectorAll(".pro_details")[1],
    message = document.querySelector(".iphone_message");
    buyN2.onclick = function(){
        message.style.display = "none";
        details.style.display = "block";
    }
}
function closeDetails2(){
    var buyN2 = document.querySelectorAll(".close_details")[1],
    details = document.querySelectorAll(".pro_details")[1],
    message = document.querySelector(".iphone_message");
    buyN2.onclick = function(){
        message.style.display = "block";
        details.style.display = "none";
    }
}
function borderadd(proX){
    var spant = document.querySelectorAll(proX);
    for(var i =0;i<spant.length;i++){
        spant[i].onclick = function(){
            for(var j=0;j<spant.length;j++){
                spant[j].style.border="1px solid #cccccc";
            }
            this.style.border = "1px solid red";
        }
    }
}
function addNum(addBtn,reduceBtn,sumBtn){
    var addButton = document.querySelector(addBtn);
    var reduceButton = document.querySelector(reduceBtn);
    var sum1 = document.querySelector(sumBtn);
    addButton.onclick = function(){
        sum1.value = Number(sum1.value) + 1;
    }
    reduceButton.onclick = function(){
        sum1.value = Number(sum1.value) - 1;
        if(sum1.value<0){
            sum1.value = 0;
        }
    }
}