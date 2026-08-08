<?php
// 数据库配置
$servername = "x.xxx.xxx.xxx";      // 如果 MySQL 在本地运行，使用 localhost
$username = "userinformation";      // MySQL 用户名
$password = "xxxxxxxxxxxxxx";     // MySQL 密码
$dbname = "userinformation";        // 使用的数据库名

// 创建数据库连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("connected defeat: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

// 获取表单数据
$age = $_POST['age'];
$residence = $_POST['residence'];
$occupation = $_POST['occupation'];
$transportation = $_POST['transportation'];
$Green_travel_preferences = $_POST['Green_travel_preferences'];
$main_parameters = $_POST['main_parameters'];
$gender = $_POST['gender'];


// 使用预处理语句防止 SQL 注入
$stmt = $conn->prepare("INSERT INTO usersubmit (age, residence, occupation, transportation, Green_travel_preferences, main_parameters, gender) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $age, $residence, $occupation, $transportation, $Green_travel_preferences, $main_parameters, $gender);

// 执行 SQL 语句
if ($stmt->execute()) {
    echo "Submit success, please return to listen the audio";
} else {
    echo "Submit failed, please try agian" . $stmt->error;
}

// 关闭连接
$stmt->close();
$conn->close();
?>

