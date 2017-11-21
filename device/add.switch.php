<?php include($_SERVER['DOCUMENT_ROOT'].'/common/header.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>添加开关 | 极客物联网</title>
  <!-- 引入 Bootstrap -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div style="padding: 10% 15% 5%;">
    <form class="form-horizontal">
        <div class="form-group" align="center">
            <img src="/image/default/switch.jpg" id="pic-show" style="width: 150px;height: 150px;border-radius: 10px;" onerror="javascript:this.src='/image/default/error.jpg';">
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">设备名称:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="name" placeholder="客厅灯" value="客厅灯">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">开指令:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="opencmd" placeholder="open" value="open">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">关指令:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="closecmd" placeholder="close" value="close">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-10">
            <div class="btn btn-default" id="btn-add-pic">更换图片</div>
            <div class="btn btn-default" id="btn-add" >提交</div>
				    <a class="btn btn-default" href="/device/Management.php">取消</a>
            </div>
        </div>
    </form>

  <?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
  </body>
</html>

<script type="text/javascript">
  var _id = (new Date()).valueOf(); 

  //所有的button引起的变化
  $("#btn-add").bind("click",function(){
    var name = $("#name").val();
    var opencmd = $("#opencmd").val();
    var closecmd = $("#closecmd").val();
    var pic = $("#pic-show")[0].src;

    //打印引起事件的标签信息
    console.log('click:', this);
    // 发送指令并等待响应
    $.ajax({
      url: "/api/device/add.switch.php",
      async: true,
      type:"GET",
      data:{"userid":user_d.userid,"name":name,"opencmd":opencmd,"closecmd":closecmd,"pic":pic},
      success: function (res) {
        console.log('success:',res);
        // 显示成功，用户确认后跳转
        if (res.resault=='success') {
              layer.msg('添加成功！', {
              time: 5000, //5s后自动关闭
              btn: ['好的']
              ,yes: function(){
                // 跳转回原来页面
                location.href = '/device/management.php';  
              }
            });
        }
        else{
            // 显示错误信息
            layer.msg('Sorroy,创建失败!'+res.msg, {
                  time: 20000, //20s后自动关闭
                  btn: ['知道了']
                  ,yes: function(){
                    layer.closeAll();
                  }
                });
          }
      },
      error:function (res) {
        console.log('fail:',res);
      }
    });
  }); 

  // 更新图片
  upload.render({
    elem: '#btn-add-pic' //绑定元素
    ,method:'POST'
    ,async:true
    ,data:{type:'switch',userid:user_d.userid,switchid:_id,'size':200}
    ,url: '/api/upload/upload.img.php' //上传接口
    ,before : function(){
      //执行上传前的回调  可以判断文件后缀等等
      layer.msg('上传中，请稍后......', {icon:16, shade:0.5, time:0});
    }
    ,done: function(res){
      //上传完毕回调
      console.log(res);
      if(res.code != 0){
      layer.msg(res.msg, {icon:2, shade:0.5, time:res.time});
    }
    else{
        layer_msg("更新图片成功！",4);
        layui.jquery('#pic-show').attr("src", res.msg);
      }
    }
    ,error: function(res){
      //请求异常回调
      console.log(res);
    }
  });
</script>


