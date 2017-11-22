<?php

// 载入全部公共函数
require_once '../functions.php';
// 判断是否登录
xiu_get_current_user();

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Settings &laquo; Admin</title>
  <link rel="stylesheet" href="/static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/static/assets/css/admin.css">
  <script src="/static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include 'inc/navbar.php'; ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>网站设置</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="form-horizontal">
        <div class="form-group">
          <label for="site_logo" class="col-sm-2 control-label">网站图标</label>
          <div class="col-sm-6">
            <input id="site_logo" name="site_logo" type="hidden">
            <label class="form-image">
              <input id="logo" type="file">
              <img src="/static/assets/img/logo.png">
              <i class="mask fa fa-upload"></i>
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="site_name" class="col-sm-2 control-label">站点名称</label>
          <div class="col-sm-6">
            <input id="site_name" name="site_name" class="form-control" type="type" placeholder="站点名称">
          </div>
        </div>
        <div class="form-group">
          <label for="site_description" class="col-sm-2 control-label">站点描述</label>
          <div class="col-sm-6">
            <textarea id="site_description" name="site_description" class="form-control" placeholder="站点描述" cols="30" rows="6"></textarea>
          </div>
        </div>
        <div class="form-group">
          <label for="site_keywords" class="col-sm-2 control-label">站点关键词</label>
          <div class="col-sm-6">
            <input id="site_keywords" name="site_keywords" class="form-control" type="type" placeholder="站点关键词">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">评论</label>
          <div class="col-sm-6">
            <div class="checkbox">
              <label><input id="comment_status" name="comment_status" type="checkbox" checked>开启评论功能</label>
            </div>
            <div class="checkbox">
              <label><input id="comment_reviewed" name="comment_reviewed" type="checkbox" checked>评论必须经人工批准</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-6">
            <button type="submit" class="btn btn-primary">保存设置</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <?php include 'inc/sidebar.php'; ?>

  <script src="/static/assets/vendors/jquery/jquery.js"></script>
  <script src="/static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>

    $(function ($) {
      // 因为老版本浏览器不支持 ObjectURL 和 FileReader

      $('#logo').on('change', function () {
        var $this = $(this)
        var files = $(this).prop('files')
        if (!files.length) return
        var file = files[0]
        if (!file.type.startsWith('image/')) return


        var formData = new FormData()
        formData.append('file', file)

        // 异步上传图片
        $.ajax({
          url: '/admin/api/upload.php',
          type: 'post',
          data: formData,
          // 是否处理数据
          processData: false,
          contentType: false,
          success: function (res) {
            $this.siblings('img').attr('src', res)
          }
        })

        // $.ajax 如果需要异步上传文件：
        // 1. data = FormData
        // 2. processData = false // 不要在jquery内部处理数据
        // 3. contentType = false

      })
      // $('#logo').on('change', function () {
      //   var files = $(this).prop('files')
      //   if (!files.length) return
      //   var file = files[0]
      //   if (!file.type.startsWith('image/')) return
      //   var url = URL.createObjectURL(file)
      //   $(this).siblings('img').attr('src', url)
      // })

      // $('#logo').on('change', function () {
      //   var $this = $(this)
      //   var files = $this.prop('files')
      //   if (!files.length) return
      //   var file = files[0]
      //   if (!file.type.startsWith('image/')) return
      //   var reader = new FileReader()
      //   reader.readAsDataURL(file)
      //   reader.onload = function () {
      //     $this.siblings('img').attr('src', this.result)
      //   }
      // })

      // 内部函数中使用外部函数定义的成员
      // 内部函数执行时 外部函数早就执行完了（释放外部作用域的成员）
      // 由于闭包的机制 导致我们任然可以访问外部函数中定义的变量
    })

  </script>
  <script>NProgress.done()</script>
</body>
</html>
