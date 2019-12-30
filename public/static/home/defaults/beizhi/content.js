var scrollFlag = true;
var canScrollFlag = false;
$("#goTop").click(function () {
    scrollFlag = false;
    $('body,html').animate({scrollTop: 0}, 100);
    setTimeout(function () {
        canScrollFlag = true;
    }, 200);
});
window.onload = function () {
    var oWin = document.getElementById("win");
    var oLay = document.getElementById("overlay");
    var oBtn = document.getElementById("popmenu");
    var oClose = document.getElementById("close");
    var right_nav = document.getElementById("right_nav");
    var right_nav_click = document.getElementById("right_nav_click");
    right_nav_click.onclick = function () {
        right_nav.style.display = "block";
        right_nav_click.style.display = "none"
    };
    oBtn.onclick = function () {
        oLay.style.display = "block";
        oWin.style.display = "block"
    };
    oLay.onclick = function () {
        oLay.style.display = "none";
        oWin.style.display = "none"
    }
};
(function($) {
    $.fn.fixDiv = function(options) {
        var defaultVal = {
            top: 10
        };
        var obj = $.extend(defaultVal, options);
        $this = this;
        var _top = $this.offset().top;
        var _left = $this.offset().left;
        $(window).scroll(function() {
            var _currentTop = $this.offset().top;
            var _scrollTop = $(document).scrollTop();
            if (_scrollTop > _top) {
                $this.offset({
                    top: _scrollTop + obj.top,
                    left: _left
                });
            } else {
                $this.offset({
                    top: _top,
                    left: _left
                });
            }
        });
        return $this;
    };
})(jQuery);
$(function(){
    //$("#search_box").fixDiv({ top: 0 });
    $('#search_close').click(function (e) {
        $(this).hide();
        $("#search_btn").val("页内查找");
        $("#search_btn").css("position","static");
    })
    $('#search_btn').click(highlight);//点击search时，执行highlight函数；   
    $('#searchstr').keydown(function (e) {
        var key = e.which;
        if (key == 13) highlight();
    })
    var i = 0;
    var sCurText;
    function highlight(){
        clearSelection();//先清空一下上次高亮显示的内容；
        var flag = 0;
        var bStart = true;
        $('#tip').text('');
        $('#tip').hide();
        var searchText = $('#searchstr').val();
        var _searchTop = $('#searchstr').offset().top+30;
        var _searchLeft = $('#searchstr').offset().left;
        if($.trim(searchText)==""){
            //alert(123);
            showTips("请输入查找内容",_searchTop,3,_searchLeft);
            return;
        }
        var searchText = $('#searchstr').val();//获取你输入的关键字；
        var regExp = new RegExp(searchText, 'g');//创建正则表达式，g表示全局的，如果不用g，则查找到第一个就不会继续向下查找了；
        var content = $("#content").text();
        if (!regExp.test(content)) {
            showTips("没有找到要查找的内容",_searchTop,3,_searchLeft);
            return;
        } else {
            if (sCurText != searchText) {
                i = 0;
                sCurText = searchText;
            }
        }
        $('#content p,#content div').each(function(){
            var html = $(this).html();
            var newHtml = html.replace(regExp, '<span class="highlight">'+searchText+'</span>');//将找到的关键字替换，加上highlight属性；
            $(this).html(newHtml);//更新；
            flag = 1;
        });
        if (flag == 1) {
            if ($(".highlight").length> 1) {
                var _top = $(".highlight").eq(i).offset().top+$(".highlight").eq(i).height();
                var _tip = $(".highlight").eq(i).parent().find("strong").text();
                if(_tip=="") _tip = $(".highlight").eq(i).parent().parent().find("strong").text();
                var _left = $(".highlight").eq(i).offset().left;
                var _tipWidth = $("#tip").width();
                if (_left > $(document).width() - _tipWidth) {
                    _left = _left - _tipWidth;
                }
                $("#tip").html(_tip).show();
                $("#tip").offset({ top: _top, left: _left });
                $("#search_btn").val("下一个 "+(i+1)+"/"+$(".highlight").length+"");
                $("#search_btn").css("position","fixed");
                $("#search_btn").css("top","0.3rem");
                $("#search_btn").css("right", (($(window).width()-$("body").width())/2+40) + "px");
                $("#search_btn").css("z-index","3");
                $("#search_close").css("right", (($(window).width()-$("body").width())/2+5) + "px");
                $("#search_close").show();
            }else{
                var _top = $(".highlight").offset().top+$(".highlight").height();
                var _tip = $(".highlight").parent().find("strong").text();
                var _left = $(".highlight").offset().left;
                $('#tip').show();
                $("#tip").html(_tip).offset({ top: _top, left: _left });
            }
            var _tWidth = $(window).width() - $(".highlight").eq(i).offset().left-4;
            /* 虽然有漏洞，但是效果过得去*/
            if(_tWidth> $("#tip").width()){ _tWidth= $("#tip").width();}
            $("#tip").css("width",_tWidth);
            $("html, body").animate({ scrollTop: _top - 92 });
            i++;
            if (i > $(".highlight").length - 1) {
                i = 0;
            }
        }
    }
    function clearSelection(){
        $('#content p,#content div').each(function(){
            //找到所有highlight属性的元素；
            $(this).find('.highlight').each(function(){
                $(this).replaceWith($(this).html());//将他们的属性去掉；
            });
        });
    }
});
//mask
var tipsDiv = '<div class="tipsClass"></div>';
$( 'body' ).append( tipsDiv );
function showTips( tips, height, time,left ){
    var windowWidth = document.documentElement.clientWidth;
    $('.tipsClass').text(tips);
    $( 'div.tipsClass' ).css({
        'top' : height + 'px',
        'left' :left + 'px',
        'position' : 'absolute',
        'padding' : '8px 6px',
        'background': '#000000',
        'font-size' : 14 + 'px',
        'font-weight': 900,
        'margin' : '0 auto',
        'text-align': 'center',
        'width' : 'auto',
        'z-index':'4',
        'color' : '#fff',
        'border-radius':'2px',
        'opacity' : '0.8' ,
        'box-shadow':'0px 0px 10px #000',
        '-moz-box-shadow':'0px 0px 10px #000',
        '-webkit-box-shadow':'0px 0px 10px #000'
    }).show();
    setTimeout( function(){$( 'div.tipsClass' ).fadeOut();}, ( time * 1000 ) );
}
var font_size_setting="font_size"+self.location.hostname.toString().replace(/\./g,"");
var font_size=getCookie(font_size_setting);
$("#content img").click(function(){
    var imgArray = [];
    var curImageSrc = canonical_uri($(this).attr('src'), window.location.host +"/");
    console.log(curImageSrc);
    var oParent = $(this).parent();
    if (curImageSrc && !oParent.attr('href')) {
        $('#content img').each(function(index, el) {
            var itemSrc = canonical_uri($(this).attr('src'),window.location.host +"/");
            imgArray.push(itemSrc);
        });
        wx.previewImage({
            current: curImageSrc,
            urls: imgArray
        });
    }
});
function canonical_uri(src, base_path)
{
    var root_page = /^[^?#]*\//.exec(location.href)[0],
        root_domain = /^\w+\:\/\/\/?[^\/]+/.exec(root_page)[0],
        absolute_regex = /^\w+\:\/\//;
    // is `src` is protocol-relative (begins with // or ///), prepend protocol
    if (/^\/\/\/?/.test(src))
    {
        src = location.protocol + src;
    }
    // is `src` page-relative? (not an absolute URL, and not a domain-relative path, beginning with /)
    else if (!absolute_regex.test(src) && src.charAt(0) != "/")
    {
        // prepend `base_path`, if any
        src = (base_path || "") + src;
    }
    // make sure to return `src` as absolute
    return absolute_regex.test(src) ? src : ((src.charAt(0) == "/" ? root_domain : root_page) + src);
}
$(".ui-btn-left_pre").click(function(){
    var   backUrl= $(this).attr('data-url');
    if ((navigator.userAgent.indexOf('MSIE') >= 0) && (navigator.userAgent.indexOf('Opera') < 0)){ // IE
        if(history.length > 0){
            window.history.go( -1 );
        }else{
            window.location.href =backUrl;
        }
    }else{ //非IE浏览器
        if (navigator.userAgent.indexOf('Firefox') >= 0 ||
            navigator.userAgent.indexOf('Opera') >= 0 ||
            navigator.userAgent.indexOf('Safari') >= 0 ||
            navigator.userAgent.indexOf('Chrome') >= 0 ||
            navigator.userAgent.indexOf('WebKit') >= 0){
            if(window.history.length > 1){
                window.history.go( -1 );
            }else{
                window.location.href =backUrl;
            }
        }else{ //未知的浏览器
            window.history.go( -1 );
        }
    }
});

$('.font_size_click').on('click',function(){
    var data_id = $(this).attr("data-id");
    $("#content p").css("font-size", data_id+"em");
    $(this).siblings().css("text-decoration","underline");
    $(this).css("text-decoration","");
    var i;
    if(data_id=="1.4"){
        i="0";
    }else if(data_id=="1.0"){
        i="2";
    }else {
        i="1";
    }
    setCookie(font_size_setting,i,7);
});