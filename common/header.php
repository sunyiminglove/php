<?php
session_start();
date_default_timezone_set("Asia/Shanghai");
?>
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
      <a class="nav-this" href="/blog" target="_self">
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
      <?php 
      // 未登入状态
      if (!isset($_SESSION['login'])) {
        echo
          '<a class="unlogin" href="/user/login.php"><i class="iconfont icon-touxiang"></i></a>
      <span><a href="/user/login.php">登入</a><a href="/user/register.php">注册</a></span>
      <p class="out-login">
        <a href=""  class="iconfont icon-qq" title="QQ登入"></a>
        <a href=""  class="iconfont icon-weibo" title="微博登入"></a>
      </p>   ';
      }
      //登入后的状态
      else 
      {
        // 获取用户信息
        include($_SERVER['DOCUMENT_ROOT']."/common/conn.php");
        $sql="select * from user where email='{$_SESSION['login']}'";
        $query=mysqli_query($con,$sql);
        $row = mysqli_fetch_array($query);

        echo "<a class='avatar' href='user/index.html'>
        <img id='image-avatar' src='/{$row['avatar']}'>
        <cite id='nickname'>{$row['nickname']}</cite>
        <i>VIP1</i>
        </a>
        <div class='nav'>
        <a href='/user/set.php'><i class='iconfont icon-shezhi'></i>设置</a>
        <a href='/user/logout.php'><i class='iconfont icon-tuichu' style='top: 0; font-size: 22px;'></i>退了</a>
        </div>";
        mysqli_close($con);
      }
      ?>     
    </div>
  </div>
</div>

<script>
//注意：导航 依赖 element 模块，否则无法进行功能性操作
layui.use('element', function(){
  var element = layui.element;
  
  //…
});
</script>
