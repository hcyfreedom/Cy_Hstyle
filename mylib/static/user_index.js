/**
 * Created by 95688 on 2016/4/14.
 */


//这是搜索的蒙态框
function openNewM(){
    search();
    var oLayer=document.getElementById("layer");
    var dell=document.getElementById("dell");
    oLayer.style.display="block";
    document.body.style.overflow="hidden";
    dell.onclick= function () {
        document.body.style.overflow="visible";
        oLayer.style.display="none";

    }
}

//这是添加管理员的蒙态框
function openNewG(){

    var oLayer=document.getElementById("layer");
    var dell=document.getElementById("dell");
    oLayer.style.display="block";
    document.body.style.overflow="hidden";
    dell.onclick= function () {
        document.body.style.overflow="visible";
        oLayer.style.display="none";

    }
}

var oBTN=document.getElementById("btnLoginM");//获取元素结点
oBTN.onclick=function(){
    openNewG();
}
