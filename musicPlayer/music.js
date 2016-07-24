/**
 * Created by 95688 on 2016/3/26.
 */
(function() {

    var play = {
        status: 'pause',
        index: 0,
        mode: 'order',
        volume: 0.7

    }
//创建audio标签，插入dom节点
    var html = '<audio id="songs" preload="auto"></audio>';
    var newNode = document.createElement('div');
    newNode.innerHTML = html;
    newNode.id = 'players';
    document.body.appendChild(newNode);
    var audio = $("#players #songs")[0];

    //这样单独写 可以减少音频加载时间
    quickly();

//进度条更新,timeFormat是自己写的 在后面
    audio.ontimeupdate = function () {
        $('#going_bar').width($('#play_bottom_bar').width() * audio.currentTime / audio.duration + 'px');
        $('#player_time').html(timeFormat(audio.currentTime));
    }

//获取总时间
    audio.onloadedmetadata = function () {
        $('#player-total-time').html(timeFormat(audio.duration));
    }

//点击进度条，progress是自己写的 在后面
    $('#play_bottom_bar').click(function (ev) {
        var progressX = progress(this, ev);
        audio.currentTime = parseInt(progressX / this.offsetWidth * audio.duration);
        $('#going_bar').width(progressX + 'px');
    })


//实现播放、停止
    $('#play_start').click (function(){
        if (play.status == 'pause') {
            musicPlay();
        } else if (play.status == 'playing') {
            musicPause();
        };
    })

//自动播放下一首
    audio.onended=function(){
        musicNext();
    }
    audio.onerror=function(){
        musicNext();
    }
//点击播放下一首
    $('#Right_bar').click(function(){
        musicNext();
    })

    //点击播放上一首
    $('#Left_bar').click(function () {
        musicPre();
    })

    //切换播放模式
    $('#play_mode').click(function(){
        playModeChange();
    })

//静音
    $('#player_mute').click(function () {
        if (audio.muted){
            audio.muted=false;
            $('.sound_one').css("background-image","url(image/sound.png)");
        }else {
            audio.muted=true;
            $('.sound_one').css("background-image","url(image/muted.png)");
        }
    })

    function timeFormat(time) {
        var minutes = Math.floor(time / 60);
        var seconds = Math.floor(time - minutes * 60);
        if (minutes < 10) {
            minutes = '0' + minutes.toString();
        }
        if (seconds < 10) {
            seconds = '0' + seconds.toString();
        };
        return minutes + ':' + seconds;
    }

    function progress(dom, ev) {
        return progressX = event.clientX - dom.getBoundingClientRect().left;
    }

    function musicPlay(){
        //audio.volume = play.volume;
        //prepareToPlay();
        play.status = 'playing';
        audio.play();
        $('#play_start').css("background-image","url(image/open2.png)") ;
    }

    function musicPause(){
        play.status = 'pause';
        audio.pause();
        $('#play_start').css("background-image","url(image/pause.png)");
    }
    function quickly(){
        audio.volume = play.volume;
        prepareToPlay();
    }

    function prepareToPlay(){
        playLoad();
        audio.load();
        if (play.status == 'pause') {
            return;
        };
        audio.play();
    }

    function playLoad(){
        // debugger;
        audio.src = playlist[play.index].songURL;
        $('#player-photo').attr('src' , playlist[play.index].poster);
        $('#player-song-name').html(playlist[play.index].songName);
        $('#player-artist-name').html( playlist[play.index].artist);
    }



    function musicNext(){
        switch (play.mode){
            case 'order':
                play.index++;
                if (play.index>playlist.length-1){
                    play.index=0;
                }
                break;
            case 'repeat':
                break;
            case 'random':
                play.index=getRandom();
                break;
            default:
                break;
        }
        prepareToPlay();
    }

    function musicPre(){
        switch (play.mode){
            case 'order':
                play.index--;
                if (play.index < 0) {
                    play.index = playlist.length - 1;
                }
                break;
            case 'repeat':
                break;
            case 'random':
                play.index=getRandom();
                break;
            default:
                break;
        }
        prepareToPlay();
    }

    function getRandom(){
        var rand;
        do {
            rand=Math.floor(Math.random()*playlist.length);
        }while (rand==play.index&&rand!=playlist.length)
        return rand;}

    function playModeChange(){
        switch (play.mode){
            case 'order':
                $('#play_mode').css("background-image","url(image/mode2.png");
                play.mode='random';
                break;
            case 'random':
                $('#play_mode').css("background-image","url(image/mode3.png");
                play.mode='repeat';
                break;
            case 'repeat':
                $('#play_mode').css("background-image","url(image/mode1.png");
                play.mode='order';
                break;
            default:
                break;
        }
    }

    })()

