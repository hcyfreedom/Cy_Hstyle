/**
 * Created by 95688 on 2016/3/29.
 */
//图片轮播
var imgnum=0;
function circulateImg(){
    setInterval("lunboImg()",3000)//setInterval方法可按照指定的周期（以毫秒计）来调用函数或计算表达式。
}
function lunboImg(){
    if(imgnum==9)
    {
        imgnum=1;
    }
    else {
        imgnum=imgnum+1;
    }
    var imgsrc="image/P"+imgnum+".jpg";
    var img=document.getElementsByClassName('lunboing');
    img[0].setAttribute('src',imgsrc);//setAttribute()方法添加指定的属性，并为其赋指定的值。如果这个指定的属性已存在，则仅设置/更改值。
}
window.onload=function(){
    circulateImg()
}//document加载完成后  开始轮播


//图片瞬间切换
$('.Left').hover(function(){
    $(this).css('background-image','url("image/turnL2.png")');
},function(){
    $(this).css('background-image','url("image/L1.png")');
})

//$('.Middle').hover(function(){
//    $(this).css('background-image','url("image/pause2.png")');
//},function(){
//    $(this).css('background-image','url("image/pause.png")');
//})

$('.Right').hover(function(){
    $(this).css('background-image','url("image/turnR2.png")');
},function(){
    $(this).css('background-image','url("image/turnR1.png")');
})

$('.favorite_left').hover(function(){
    $(this).css('background-image','url("image/store2.png")');
},function(){
    $(this).css('background-image','url("image/store.png")');
})

$('.favorite_right').hover(function(){
    $(this).css('background-image','url("image/share2.png")');
},function(){
    $(this).css('background-image','url("image/share.png")');
})

//$('.sound_one').hover(function(){
//    $(this).css('background-image','url("image/sound2.png")');
//},function(){
//    $(this).css('background-image','url("image/sound.png")');
//})

//$('.sound_two').hover(function(){
//    $(this).css('background-image','url("image/xun2.png")');
//},function(){
//    $(this).css('background-image','url("image/xun.png")');
//})

$('.sound_three').hover(function(){
    $(this).css('background-image','url("image/menu2.png")');
},function(){
    $(this).css('background-image','url("image/menu.png")');
})
