<?php 
// 数据库连接信息
$servername = "X.xxx.xxx.xxx";  // 数据库服务器
$username = "soundcomfort";         // 数据库用户名
$password = "xxxxxxxxxxxxxxx";             // 数据库密码
$dbname = "soundcomfort";  // 数据库名称

// 创建数据库连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

// 检查POST请求中的数据
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 调试：查看接收到的数据
    error_log("POST data received: " . print_r($_POST, true)); // 打印 POST 数据到日志

    // 从 POST 中获取音频ID
    $audio_id = isset($_POST['audio_id']) ? $_POST['audio_id'] : null;

    // 获取 POST 表单数据
    $unpleasantness = isset($_POST['Unpleasantness']) ? $_POST['Unpleasantness'] : null;  // 用户对音频愉悦度的评价
    $loudness = isset($_POST['loudness']) ? $_POST['loudness'] : null;  // 用户对音频响度的评价
    $comfort = isset($_POST['comfort']) ? $_POST['comfort'] : null;  // 用户对音频舒适度的评价
    $annoyance = isset($_POST['Annoyance']) ? $_POST['Annoyance'] : null;  // 用户对音频干扰度的评价
    $emotional_impact = isset($_POST['Emotional_Impact']) ? $_POST['Emotional_Impact'] : null;  // 用户对音频情绪影响的评价

    // 调试：检查变量
    error_log("Received values: audio_id=$audio_id, unpleasantness=$unpleasantness, loudness=$loudness, comfort=$comfort, annoyance=$annoyance, emotional_impact=$emotional_impact");

    // 如果有任意一个字段为空，直接返回失败
    if (!$audio_id || !$unpleasantness || !$loudness || !$comfort || !$annoyance || !$emotional_impact) {
        error_log("Missing fields. Please ensure all data is passed.");
        echo json_encode(["success" => false, "message" => "提交失败，请检查数据是否完整。"]);
        exit;
    }

    // 插入数据到数据库
    $stmt = $conn->prepare("INSERT INTO questionnaire_responses (audio_id, unpleasantness, loudness, comfort, annoyance, emotional_impact) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $audio_id, $unpleasantness, $loudness, $comfort, $annoyance, $emotional_impact);

    if ($stmt->execute()) {
        // 返回成功的响应
        echo json_encode(["success" => true]);
    } else {
        // 调试：查看 SQL 错误
        error_log("Database insert failed: " . $stmt->error);
        echo json_encode(["success" => false, "message" => "提交失败，请稍后再试。"]);
    }

    // 关闭数据库连接
    $stmt->close();
    $conn->close();
}
?>
