<html>
<head>
  <meta charset="utf-8">
  <!-- <title>Geek-Iot | 极客社区</title> -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="keywords" content="geek,geekiot,物联网,物联网社区">
  <meta name="description" content="极客社区是极客物联网开发平台的官网社区，致力于为物联网开发提供强劲动力">

  <link rel="stylesheet" href="/frame/layui-v2.1.0/layui/css/layui.css">
  <link rel="stylesheet" href="/common/res/css/global.css">
  <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/frame/layui-v2.1.0/layui/layui.js"></script>
</head>
<div class="header">
  <div class="main" style="width: 90%;">
    <a class="logo" href="/index.php" title="Geek-Iot">极客物联网</a>
    <div class="nav">
      <a href="/index.php">
        <i class="iconfont"></i>首页
      </a>
      <a  href="/blog/index.php" target="_self">
        <i class="iconfont"></i>社区
      </a>
      <a href="#" target="">
        <i class="iconfont"></i>控制台
      </a>
      <a href="/about/index.php" target="">
        <i class="iconfont"></i>关于
      </a>
    </div>
    
    <div class="nav-user">
      <!-- 建立视图。用于呈现模板渲染结果。 -->
      <div id="view"></div>   
    </div>
  </div>
</div>

<script>
  // 定义用户数据变量
  var user_d;
  // 加载需要的模块
  layui.use(['laytpl','element','jquery','layer'], function(){
  var element = layui.element,$ = layui.jquery,layer=layui.layer,laytpl = layui.laytpl;
  // 头部分当前标签高亮显示
  $(document).ready(function(){  
    $(".nav a").each(function(){  
        $this = $(this);
        if($this[0].href==String(window.location)){  
            $this.addClass("nav-this");  
        }
    });  
  });  
  //获取用户登陆信息
  $.ajax({
    url: "../api/user/user.php",
    success: function (res) {
        console.log('success:',res);
        user_d = res;
        //渲染数据
        var getTpl = demo.innerHTML;
        var view = document.getElementById('view');
        laytpl(getTpl).render(user_d, function(html){
          view.innerHTML = html;
        });
    },
    error:function (res) {
        console.log('fail:',res);
    }
  });
});
</script>

<!-- 模板 -->
<script id="demo" type="text/html">
  <!-- 已登录 -->
  {{#  if(user_d.login === "true"){ }}
    <a class='avatar' href='/user/index.php'>
    <img id='image-avatar' src='/{{ user_d.avatar }}'>
    <cite id='nickname'>{{ user_d.nickname }}</cite>
    <i>VIP1</i>
    </a>
    <div class='nav'>
    <a href='/user/set.php'><i class='iconfont icon-shezhi'></i>设置</a>
    <a href='/user/logout.php'><i class='iconfont icon-tuichu' style='top: 0; font-size: 22px;'></i>退了</a>
    </div>  
  {{# }else { }} 
  <!-- 未登录 -->
    <a class="unlogin" href="/user/login.php"><i class="iconfont icon-touxiang"></i></a>
    <span><a href="/user/login.php">登入</a><a href="/user/register.php">注册</a></span>
    <p class="out-login">
      <a href=""  class="iconfont icon-qq" title="QQ登入"></a>
      <a href=""  class="iconfont icon-weibo" title="微博登入"></a>
    </p>
  {{#  } }} 
  </ul>
</script>
