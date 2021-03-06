<?php /*a:2:{s:66:"D:\download\ukcms\application\home\view\defaults\index\search.html";i:1553153629;s:60:"D:\download\ukcms\application\home\view\defaults\layout.html";i:1553153629;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Standard Meta -->
        <meta charset="utf-8" />
        
<title><?php echo htmlentities($title); ?>站内搜索</title>	
<meta name="keywords" content="<?php echo htmlentities($keywords); ?>,站内搜索" />
<meta name="description" content="<?php echo htmlentities($description); ?>,站内搜索" />

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
        $('#mid').change(function () {
            var changMid = $(this).val();
            var ids = ',';
             $('#cid').val('');
             $('#cid').parent().find('div.text').html('所有栏目').addClass('default');
            $('#cid option').prop('disabled', false).each(function () {
                if (changMid != $(this).data('model')&&$(this).prop('value')) {
                    $(this).prop('disabled', true);
                    ids += $(this).prop('value') + ',';
                }
            });
            $('#cid').parent().find('.menu>div.item').removeClass('disabled').removeClass('selected').removeClass('active').each(function () {
                if (ids.indexOf($(this).data('value')) > 0) {
                    $(this).addClass('disabled');
                }
            });
        });
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
                                <?php $sql_list=model('ModelField')->getDataList("model", "purpose='column' and status='1' and create_time <1553155000", "id,title", "", "orders,id desc", "", null, 0, "");  $sum=count($sql_list);  foreach($sql_list as $key=>$vo): ?>
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
            <h3>高级搜索</h3>
            <p>按模型、栏目、字段的高级搜索</p>
        </div>  
    </div>
</div>

<div class="ui container" id="box">
    <div class="ui raised segment">
        <div class="ui blue ribbon label large">一共<?php echo htmlentities($list['total']); ?>条 <?php echo htmlentities($list['last_page']); ?>页 每页<?php echo htmlentities($list['per_page']); ?>条</div>
        <div class="ui divider"></div>
        <form method="get" action="">
            <div class="ui four column grid doubling">
                <div class="column">
                    <select class="ui fluid  search dropdown" name="mid" id="mid">
                        <option value="0">=所有模型=</option>
                        <?php if(is_array($modellist) || $modellist instanceof \think\Collection || $modellist instanceof \think\Paginator): $i = 0; $__LIST__ = $modellist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <option  value="<?php echo htmlentities($key); ?>" <?php if($key==$mid): ?>selected<?php endif; ?>><?php echo htmlentities($vo['title']); ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
                <div class="column">
                    <select class="ui fluid  search dropdown" name="cid"  id="cid">
                        <option value="0">=所有栏目=</option>
                        <?php if(is_array($columnlist) || $columnlist instanceof \think\Collection || $columnlist instanceof \think\Paginator): $i = 0; $__LIST__ = $columnlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                          <option <?php if($vo['model_id']!=$mid): ?>disabled<?php endif; ?> data-model="<?php echo htmlentities($vo['model_id']); ?>" value="<?php echo htmlentities($vo['id']); ?>"  <?php if($vo['id']==$cid): ?>selected<?php endif; ?>><?php echo str_repeat('- ', $vo['deep']-1); ?><?php echo htmlentities($vo['title']); ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select> 
                </div>
                <div class="column">
                    <div class="ui action left icon input small">
                        <i class="search icon"></i>
                        <input type="text" name="keyword" placeholder="输入关键词..." value="<?php echo htmlentities($keyword); ?>">
                        <button class="ui blue button" type="submit">搜索</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="ui divided  items">
            <?php if(is_array($list['data']) || $list['data'] instanceof \think\Collection || $list['data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $list['data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="item">
                <?php if($vo['cover']['path']): ?>
                <div class="ui small image">
                    <img src="/public/uploads/<?php echo htmlentities($vo['cover']['path']); ?>" alt="<?php echo htmlentities($vo['title']); ?>" >
                </div>
                <?php endif; ?>
                <div class="content">
                    <a class="header" href="<?php echo htmlentities($vo['url']); ?>"><div class="ui blue horizontal label"><?php echo htmlentities($columList[$vo['cname']]['title']); ?></div> <?php echo str_ireplace($keyword,"<font style='color:red'>$keyword</font>",$vo['title']); ?></a>
                    <div class="meta">
                        <span><?php echo date('Y-m-d H:i:s',$vo['create_time']); ?></span>
                    </div>
                    <div class="description">
                        <p><?php echo str_ireplace($keyword,"<font style='color:red'>$keyword</font>",$vo['description']); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <?php echo $page; ?>
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