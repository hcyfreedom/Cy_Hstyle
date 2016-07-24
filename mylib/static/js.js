/**
 * Created by 95688 on 2016/4/5.
 */

//鼠标经过一级菜单时出现二级菜单
function  showsubmenu(li){
    var submenu=li.getElementsByTagName("ul")[0];
    submenu.style.display="block";
}
//鼠标离开时二级菜单消失
function  hidesubmenu(li){
    var submenu=li.getElementsByTagName("ul")[0];
    submenu.style.display="none";
}
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

var oBTN=document.getElementById("btnSearch");//获取元素结点
oBTN.onclick=function(){
    openNewG();
}
var oBTNs=document.getElementById("btnSearch_icon");//获取元素结点
oBTNs.onclick=function(){
    openNewG();
}