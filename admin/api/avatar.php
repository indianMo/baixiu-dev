<?php

// 如果没有提交邮箱，那就返回空
if (empty($_GET['email'])) {
  exit();
}

// 接收 email
$email = $_GET['email'];

// 返回头像
require '../../config.php';
require '.././function.php';

$sql = "select * from users where email = '{$email}' limit 1;";

$user = xiu_fetch_one($sql);
if (!$user) {
  // 用户名不存在
  exit();
}2

echo $user['avatar'];
