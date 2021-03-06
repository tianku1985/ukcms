<?php /*a:4:{s:83:"D:\download\ukcms\application\home\view\defaults\column\content\productcontent.html";i:1553153629;s:60:"D:\download\ukcms\application\home\view\defaults\layout.html";i:1553153629;s:61:"D:\download\ukcms\application\home\view\defaults\comment.html";i:1553153629;s:59:"D:\download\ukcms\application\home\view\defaults\right.html";i:1553153629;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Standard Meta -->
        <meta charset="utf-8" />
        
<title><?php echo htmlentities($data['title']); ?>-<?php echo htmlentities($info['meta_title']); ?>-<?php echo htmlentities($title); ?></title>	
<meta name="keywords" content="<?php echo htmlentities($info['meta_keywords']); ?>,<?php echo htmlentities($keywords); ?>" />
<meta name="description" content="<?php echo htmlentities($info['meta_description']); ?>-<?php echo htmlentities($description); ?>" />

        <meta name="author" content="YX">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="renderer" content="webkit">
        <meta http-equiv="Cache-Control" content="no-siteapp" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/>
        <script type="text/javascript">
            window.onload = function () {
                if (navigator.appName == "Microsoft Internet Explorer" && parseInt(navigator.appVersion.split(";")[1].replace(/[ ]/g, "").replace("MSIE", "")) < 9) {
                    document.body.innerHTML = "";
                    alert("你的浏览器太古老,网页不支持IE9以下版本~");
                }
            };
        </script> 
        <link rel="stylesheet" type="text/css" href="/public/static/semantic/semantic.min.css">
        <link rel="stylesheet" type="text/css" href="/public/static/home/defaults/css/ukcms.css">
        <script src="/public/static/jquery.min.js" ></script>
        <script src="/public/static/semantic/semantic.min.js"></script>
        <script>
            $(document).ready(function () {
                /**小屏幕下导航菜单**/
                $('#sideMenuCon').html($('#topMenuCon').html()).find('.menu').addClass('vertical');
                $('#sideMenuCon').find('.toc.item').remove();
                $('#sideMenuCon').find('.right.menu').remove();
                //弹出菜单
                $('#sideMenuCon').sidebar('attach events', '.toc.item');
                /**小屏幕下导航菜单**/
                //下拉菜单
                $('.ui.dropdown').dropdown();
                //图片鼠标特效
                $('.special.cards .image').dimmer({
                    on: 'hover'
                });
                //顶部菜单下拉效果
                $('.ui.menu .ui.dropdown').dropdown({
                    on: 'hover'
                });
                //顶部搜索触发
                $('#searchicon').click(function () {
                    $('#search').submit();
                });
                $('#midSelect div').click(function () {
                    $('#midInput').val($(this).data('id'));
                });
            });
        </script>
        
<script>
    $(document).ready(function () {
        //栏目右侧折叠菜单
        $('.ui.styled.accordion').accordion({
            selector: {
                trigger: '.title .icon'
            }
        });
        //弹出图片
        $('#cshap img').click(function () {
            $('#photoshow  img').attr('src', $(this).attr('data-bind'));
            $('#photoshow').modal('show');
        });
        //tab切换
        $('#comment  .item').tab();
        //形状动画
        $('.direction .button').click(function () {
            var direction = $(this).data('direction');
            var animation = $(this).data('animation');
            if (direction && animation) {
                $('#cshap').shape(animation + '.' + direction);

            }
        });
        $('.direction .button').popup({position: 'bottom left'});
    });
</script>

    </head>
    <body>
        <?php if(isset($memberInfo)): ?>
        <div class="topbar">
            <div class="topbar-left"><i class="volume up icon"></i>演示通过应用钩子调用会员登录状态</div>
            <div class="topbar-right">
              <?php if($memberInfo): ?>
                 <a class="ui primary button tiny" href="<?php echo appUrl('member','index/index'); ?>"><i class="icon user"></i><?php echo htmlentities($memberInfo); ?></a>  <a class="ui button tiny" href="<?php echo appUrl('member','open/loginout'); ?>"><i class="icon power"></i>退出</a>
              <?php else: ?>
                 <a class="ui primary button tiny" href="<?php echo appUrl('member','open/login'); ?>">登录</a>  <a class="ui  button tiny" href="<?php echo appUrl('member','open/register'); ?>">注册</a>
              <?php endif; ?>
            </div>
        </div>
        <div style="clear:both"></div>
        <?php endif; ?>
        <!-- Sidebar Menu -->
        <div class="ui vertical inverted blue sidebar menu top " id='sideMenuCon'></div>
        <div class="ui inverted vertical blue center aligned segment">
            <div class="ui container">
                <div class="large  ui  inverted blue menu menu-big" id='topMenuCon'>
                    <a class="toc item">
                        <i class="sidebar icon"></i>
                    </a>
                    <a href="<?php echo url('index/index'); ?>" class="<?php if(0==$rootId): ?>active<?php endif; ?> header item">
                        <img class="logo" src="/public/uploads/<?php echo config('web_site_logo')['path']; ?>" width="100" alt="UKcmsLogo">
                    </a>
                    <!--查询栏目存储在$colums中-->
                    <?php $colums= model('Column')->getColumn("tree", "id,path,name,title,type,url", 'id', 0, "show"); ?>
                    <!--演示四层栏目调用-->
                    <?php if(is_array($colums) || $colums instanceof \think\Collection || $colums instanceof \think\Paginator): $i = 0; $__LIST__ = $colums;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;if(!isset($v1['cnode'])): ?><a class="item <?php if($v1['name']==$rootName): ?>active<?php endif; ?>" href="<?php echo htmlentities($v1['url']); ?>"><?php echo htmlentities($v1['title']); ?></a><?php else: ?>
                    <div class="ui dropdown item <?php if($v1['name']==$rootName): ?>downaction<?php endif; ?>">
                        <a href="<?php echo htmlentities($v1['url']); ?>"><?php echo htmlentities($v1['title']); ?></a><i class="dropdown icon"></i>
                        <div class="menu">
                            <?php if(is_array($v1['cnode']) || $v1['cnode'] instanceof \think\Collection || $v1['cnode'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v1['cnode'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;if(!isset($v2['cnode'])): ?><a class="item" href="<?php echo htmlentities($v2['url']); ?>"><?php echo htmlentities($v2['title']); ?></a><?php else: ?>
                            <div class="item">
                                <a href="<?php echo htmlentities($v2['url']); ?>"><?php echo htmlentities($v2['title']); ?></a><i class="dropdown icon"></i>
                                <div class="menu">
                                    <?php if(is_array($v2['cnode']) || $v2['cnode'] instanceof \think\Collection || $v2['cnode'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v2['cnode'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v3): $mod = ($i % 2 );++$i;if(!isset($v3['cnode'])): ?><a class="item" href="<?php echo htmlentities($v3['url']); ?>"><?php echo htmlentities($v3['title']); ?></a><?php else: ?>
                                    <div class="item">
                                        <a href="<?php echo htmlentities($v3['url']); ?>"><?php echo htmlentities($v3['title']); ?></a><i class="dropdown icon"></i>
                                        <div class="menu">
                                            <?php if(is_array($v3['cnode']) || $v3['cnode'] instanceof \think\Collection || $v3['cnode'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v3['cnode'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v4): $mod = ($i % 2 );++$i;?>
                                            <a class="item" href="<?php echo htmlentities($v4['url']); ?>"><?php echo htmlentities($v4['title']); ?></a>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    <!--演示四层栏目调用-->
                    <div class="right menu">
                        <div class="ui dropdown item "><i class="angle double   down icon"></i>
                            <div class="menu" id="midSelect">
                                <div class="item active" data-id="0">所有模型</div>
                                <?php $sql_list=model('ModelField')->getDataList("model", "purpose='column' and status='1' and create_time <1553157357", "id,title", "", "orders,id desc", "", null, 0, "");  $sum=count($sql_list);  foreach($sql_list as $key=>$vo): ?>
                                <div class="item"  data-id="<?php echo htmlentities($vo['id']); ?>"><?php echo htmlentities($vo['title']); ?></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="item">
                            <form id="search"  method="get" action="<?php echo url('index/search'); ?>">
                                <div class="ui transparent icon input  inverted  blue"> 
                                    <input type="hidden" name="mid" value="0" id="midInput">
                                    <input class="prompt" name="keyword"  type="text" placeholder="搜索..." size="10">
                                    <i class="search link icon" id="searchicon"></i>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
<div class="ui  padded grid " id="listBanner">
    <div class="blue column">
        <div class="ui container ">
            <h3><?php echo htmlentities($info['title']); ?></h3>
            <p><?php echo htmlentities($info['meta_description']); ?></p>
        </div>  
    </div>
</div>

<div class="ui container" id="box">
    <div class="ui  grid stackable">
        <div class="ten wide column">
            <div class="ui  breadcrumb">
                <a class="section" href="<?php echo url('index/index'); ?>"> 首页</a>
                <?php if(is_array($crumbs) || $crumbs instanceof \think\Collection || $crumbs instanceof \think\Paginator): $i = 0; $__LIST__ = $crumbs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <i class="right chevron icon divider"></i><a class="section" href="<?php echo htmlentities($vo['url']); ?>"> <?php echo htmlentities($vo['title']); ?></a>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

            <div class="ui segment">
                <h4 class="ui header"><?php echo htmlentities($data['title']); ?></h4>
                <div class="contentInfo"><i class="time icon"></i><?php echo date('Y-m-d H:i:s',$data['create_time']); ?>&nbsp;&nbsp;&nbsp;<i class="unhide icon"></i> <?php echo htmlentities($data['hits']); ?> &nbsp;&nbsp;&nbsp; </div>

                <div class="ui segment">

                    <div class="ui  grid stackable">
                        <div class="eight wide column">
                            <div class="ui shape auto" id="cshap">
                                <div class="sides">
                                    <?php if(is_array($data['pictures']) || $data['pictures'] instanceof \think\Collection || $data['pictures'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['pictures'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?>
                                    <div class="first side <?php if($i==1): ?>active<?php endif; ?>">
                                        <img src="/public/uploads/<?php echo htmlentities($p['thumb']); ?>" class="ui centered image rounded cursorPoint" data-bind="/public/uploads/<?php echo htmlentities($p['path']); ?>" alt="<?php echo htmlentities($data['title']); ?>">
                                    </div>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div>
                            <div class="ui ignored divider"></div>
                            <div class="ui ignored icon direction buttons">
                                <div class="ui button blue" data-animation="flip" title="左滚动" data-direction="left"><i class="left long arrow icon"></i></div>
                                <div class="ui button blue" data-animation="flip" title="上滚动" data-direction="up"><i class="up long arrow icon"></i></div>
                                <div class="ui icon button blue" data-animation="flip" title="下滚动" data-direction="down"><i class="down long arrow icon"></i></div>
                                <div class="ui icon button blue" data-animation="flip" title="右滚动" data-direction="right"><i class="right long arrow icon"></i></div>
                            </div>
                            <div class="ui ignored icon direction buttons">
                                <div class="ui button blue" title="旋转下一张" data-animation="flip" data-direction="over"><i class="retweet icon"></i></div>
                                <div class="ui button blue" title="旋转上一张" data-animation="flip" data-direction="back"><i class="flipped retweet icon"></i></div>
                            </div>

                        </div>
                        <div class="eight wide column">
                            <span class="ui orange tag label">￥ <?php echo htmlentities($data['price']); ?></span>
                            <div class="ui ignored divider"></div>
                            型号：<?php echo htmlentities($data['model']); ?>
                            <div class="ui ignored divider"></div>
                            品牌：<?php echo htmlentities($data['brand']); ?>
                            <div class="ui ignored divider"></div>
                            颜色：
                            <?php if(is_array($data['color']) || $data['color'] instanceof \think\Collection || $data['color'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['color'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <?php echo htmlentities($vo); ?> 
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                    </div>
                </div>
                <div><?php echo $data['content']; ?></div>

                <div class="ui horizontal divider">相关信息 </div>

                <div class="ui relaxed list">
                    <div class="item">
                        上一篇： <?php if(empty($prev) || (($prev instanceof \think\Collection || $prev instanceof \think\Paginator ) && $prev->isEmpty())): ?>没有了 ...<?php else: ?><a href="<?php echo htmlentities($prev['url']); ?>"><?php echo htmlentities($prev['title']); ?></a><?php endif; ?>
                    </div>
                    <div class="item">
                        下一篇： <?php if(empty($next) || (($next instanceof \think\Collection || $next instanceof \think\Paginator ) && $next->isEmpty())): ?>没有了 ...<?php else: ?><a href="<?php echo htmlentities($next['url']); ?>"><?php echo htmlentities($next['title']); ?></a><?php endif; ?>
                    </div>
                </div>
                <div class="ui top attached tabular menu" id="comment">
    <a class="active item" data-tab="first">评论</a>
    <a class="item" data-tab="second">评论内容</a>
</div>
<div class="ui bottom attached active tab segment" data-tab="first">
    <form class="ui reply form" action="<?php echo url('single/index',['id'=>6]); ?>" method="post">
        <input name="modelField[mid]" type="hidden" value="<?php echo htmlentities($info['model_id']); ?>">
        <input name="modelField[did]" type="hidden" value="<?php echo htmlentities($data['id']); ?>">
        <div class="field">
            <input name="modelField[commenter]" placeholder="留言者">
        </div>
        <div class="field">
            <textarea name="modelField[message]" placeholder="留言内容"></textarea>
        </div>
        <?php if(config('captcha_signin_model')): ?>
        <div class="inline fields">
            <div class="field"><input type="text" placeholder="验证码" name="captcha" size="6"></div>
            <div class="field"><img src="<?php echo captcha_src(); ?>" width="129" height="40"  id="captcha" style="cursor: pointer;" onclick="this.src = '<?php echo captcha_src(); ?>?m=' + Math.random();" title="点击刷新" alt="captcha" /></div>
        </div>
        <?php endif; ?>
        <?php echo token(); ?>
        <button class="ui blue labeled submit icon button" type="submit"><i class="icon edit"></i>提交我的评论 </button>
    </form>
</div>
<div class="ui bottom attached tab segment" data-tab="second">
    <div class="ui comments">
        <?php $sql_list=model('ModelField')->getDataList("comment", "mid='".$info['model_id']."' and did='".$data['id']."' and status='1' and create_time <1553157357", "id,commenter,message,create_time", "", "orders,id desc", "", null, 0, "");  $sum=count($sql_list);  foreach($sql_list as $key=>$vo): ?>
        <div class="comment">
            <div class="content">
                <a class="author"><?php echo htmlentities($vo['commenter']); ?></a>
                <div class="metadata">
                    <span class="date"><?php echo htmlentities($vo['create_time']); ?></span>
                </div>
                <div class="text"><?php echo htmlentities($vo['message']); ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
            </div>
        </div>

        <div class="six wide column" id="rightComun">
            <!--查询当前栏目子栏目存储在$columChild中-->
<?php $columChild= model('Column')->getColumn("tree", "id,path,name,title,type,url", 'id', $info['id'], "show"); if(!(empty($columChild) || (($columChild instanceof \think\Collection || $columChild instanceof \think\Paginator ) && $columChild->isEmpty()))): ?>
<div class="ui styled accordion">
    <!--此处演示调用当前栏目下级 ,如果需要调用固定栏目标签,key改为栏目ID即可-->
    <?php if(is_array($columChild) || $columChild instanceof \think\Collection || $columChild instanceof \think\Paginator): $i = 0; $__LIST__ = $columChild;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
    <div class="title"> <?php if(isset($v1['cnode'])): ?><i class="dropdown icon"></i><?php endif; ?><a href="<?php echo htmlentities($v1['url']); ?>"><?php echo htmlentities($v1['title']); ?></a></div>
    <?php if(isset($v1['cnode'])): ?>
    <div class="content">
        <div class="accordion  hidden">
            <?php if(is_array($v1['cnode']) || $v1['cnode'] instanceof \think\Collection || $v1['cnode'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v1['cnode'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;?>
            <div class="title"> <?php if(isset($v2['cnode'])): ?><i class="dropdown icon"></i><?php endif; ?><a href="<?php echo htmlentities($v2['url']); ?>"><?php echo htmlentities($v2['title']); ?></a></div>
            <?php if(isset($v2['cnode'])): ?>
            <div class="content">
                <div class="accordion  hidden">
                    <?php if(is_array($v2['cnode']) || $v2['cnode'] instanceof \think\Collection || $v2['cnode'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v2['cnode'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v3): $mod = ($i % 2 );++$i;?>
                    <div class="title"><a href="<?php echo htmlentities($v3['url']); ?>"><?php echo htmlentities($v3['title']); ?></a></div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <?php endif; ?>
    <?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<?php endif; ?>

<div class="ui segment">
    <div class="ui top attached large  label blue">图集推荐</div>
    <div class="ui two column grid ">
        <?php $sql_list=model('ModelField')->getDataList("photo", "status='1' and create_time <1553157357", "id,cname,title,cover", "", "orders,id desc", "2", null, 0, "1");  $sum=count($sql_list);  foreach($sql_list as $key=>$vo): ?>
        <div class="column">
            <div class="ui fluid image">
                <a href="<?php echo htmlentities($vo['url']); ?>" class="ui medium rounded  image">
                    <img  src="/public/uploads/<?php echo htmlentities($vo['cover']['thumb']); ?>" alt="<?php echo htmlentities($vo['title']); ?>">
                    <div class="ui bottom attached large  label grey titFilter"><?php echo htmlentities($vo['title']); ?></div>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="ui segment">
    <div class="ui top attached large  label blue">热门&推荐文章</div>
    <div class="ui divided list articleList">
        <?php $sql_list=model('ModelField')->getDataList("article", "status='1' and create_time <1553157357", "id,cname,title,description,create_time", "", "hits desc", "4", null, 0, "1");  $sum=count($sql_list);  foreach($sql_list as $key=>$vo): ?>
        <div class="item">
            <span class="right floated"><?php echo date('Y-m-d',$vo['create_time']); ?></span>
            <a href="<?php echo htmlentities($vo['url']); ?>"><i class="file outline icon"></i><?php echo htmlentities($vo['title']); ?></a>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="ui segment">
    <div class="ui top attached large  label blue">随机文章</div>
    <div class="ui divided list articleList">
        <?php $sql_list=model('ModelField')->getDataList("article", "status='1' and create_time <1553157357", "id,cname,title,description,create_time", "", "[rand]", "4", null, 0, "");  $sum=count($sql_list);  foreach($sql_list as $key=>$vo): ?>
        <div class="item">
            <span class="right floated"><?php echo date('Y-m-d',$vo['create_time']); ?></span>
            <a href="<?php echo htmlentities($vo['url']); ?>"><i class="file outline icon"></i><?php echo htmlentities($vo['title']); ?></a>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="ui segment">
    <div class="ui top attached large  label blue">最新产品</div>
    <div class="ui two column grid ">
        <?php $sql_list=model('ModelField')->getDataList("product", "status='1' and create_time <1553157357", "id,cname,title,cover", "", "create_time desc", "2", null, 0, "");  $sum=count($sql_list);  foreach($sql_list as $key=>$vo): ?>
        <div class="column">
            <div class="ui fluid image">
                <a href="<?php echo htmlentities($vo['url']); ?>" class="ui medium rounded  image" >
                    <img  src="/public/uploads/<?php echo htmlentities($vo['cover']['thumb']); ?>" alt="<?php echo htmlentities($vo['title']); ?>">
                    <div class="ui bottom attached large  label grey titFilter"><?php echo htmlentities($vo['title']); ?></div>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>


        </div>
    </div>
</div>

<div class="ui modal" id="photoshow">
    <i class="close icon"></i>
    <div class="header">
        <?php echo htmlentities($data['title']); ?>
    </div>
    <div class="content">
        <img class="ui centered image rounded " src="" alt="<?php echo htmlentities($data['title']); ?>">
    </div>
</div>

        <div class="ui inverted vertical blue footer segment">
            <div class="ui container">
                <div class="ui stackable inverted divided equal height stackable grid">
                    <div class="three wide column">
                        <h4 class="ui inverted header">联系我们</h4>
                        <div class="ui inverted link list">
                            <a href="http://www.ukcms.com" class="item"><i class="linkify icon"></i> ukcms.com</a>
                            <a href="mail:yxcms@qq.com" class="item"><i class="mail outline icon"></i> yxcms@qq.com</a>
                            <a href="#" class="item"><i class="comments icon"></i> YXcms1999</a>
                        </div>
                    </div>
                    <div class="four wide column">
                        <h4 class="ui inverted header">环境要求</h4>
                        <div class="ui inverted link list">
                            <p>
                                PHP 5.6+ & Mysql<br>
                                Apache / Nginx<br>
                                Versions FF, Chrome, IE (aka 10+)
                            </p>
                        </div>
                    </div>
                    <div class="seven wide column">
                        <h4 class="ui inverted header">版权信息</h4>
                        <p>
                            <?php echo config('sysinfo'); ?><br>
                            php开源内容管理系统<br>
                            Copyright @ 2017 灵吉网络科技有限公司. All right reserved. <?php echo config('web_site_icp'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <?php echo config('web_site_statistics'); ?>
    </body>
</html> 