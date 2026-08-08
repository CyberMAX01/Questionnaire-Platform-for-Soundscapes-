<?php
// 数据库配置
$servername = "8.134.237.125";      // 如果 MySQL 在本地运行，使用 localhost
$username = "userinformation";      // MySQL 用户名
$password = "BzFRsxrbD7jz7mm6";     // MySQL 密码
$dbname = "userinformation";        // 使用的数据库名

// 创建数据库连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("connected defeat: " . $conn->connect_error);
}

// 获取表单数据
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// 使用预处理语句防止 SQL 注入
$stmt = $conn->prepare("INSERT INTO submissions (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);

// 执行 SQL 语句
if ($stmt->execute()) {
    echo "submit information successed, please return to the web page to listen the audio";
} else {
    echo "submit information failed: " . $stmt->error;
}

// 关闭连接
$stmt->close();
$conn->close();
?>

