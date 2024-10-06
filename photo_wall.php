<?php
// 开启错误报告，方便调试
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 数据库连接设置
$host = "sql100.infinityfree.com";  // InfinityFree 给的数据库主机名
$username = "if0_37428057"; // 数据库用户名
$password = "kuyoMmXjx2hNbvC"; // 数据库密码
$dbname = "if0_37428057_114514";   // 数据库名称

// 创建连接
$conn = new mysqli($host, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 处理上传图片和主题
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image']) && isset($_POST['theme'])) {
    $image = $_FILES['image'];
    $theme = $_POST['theme'];  // 获取主题输入
    $target_dir = "uploads/";  // 确保这个目录存在并且可写
    $target_file = $target_dir . uniqid() . "_" . basename($image["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // 检查是否是图像文件
    if (isset($_POST["submit"])) {
        $check = getimagesize($image["tmp_name"]);
        if ($check !== false) {
            echo "文件是一个图像 - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "文件不是图像.";
            $uploadOk = 0;
        }
    }

    // 检查文件是否已存在
    if (file_exists($target_file)) {
        echo "抱歉，文件已经存在.";
        $uploadOk = 0;
    }

    // 限制文件大小（可选）
    if ($image["size"] > 500000) {
        echo "抱歉，文件太大.";
        $uploadOk = 0;
    }

    // 仅允许特定文件格式
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "抱歉，只允许 JPG, JPEG, PNG & GIF 格式的文件.";
        $uploadOk = 0;
    }

    // 检查 $uploadOk 是否为 0，表示出错
    if ($uploadOk == 0) {
        echo "抱歉，文件未上传.";
    } else {
        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            echo "文件 " . htmlspecialchars(basename($image["name"])) . " 上传成功.";
            // 插入文件路径和主题到数据库
            $stmt = $conn->prepare("INSERT INTO photos (image_path, theme) VALUES (?, ?)");
            $stmt->bind_param("ss", $target_file, $theme);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "抱歉，上传过程中发生错误.";
        }
    }
}

// 获取所有图片和主题
$sql = "SELECT * FROM photos ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>照片墙</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to right, #EEc9A3, #EF629F);
        }
        .photo-container {
            display: flex;
            flex-wrap: wrap;
        }
        .photo-item {
            margin: 10px;
        }
        img {
            max-width: 200px;
            height: auto;
        }
        .theme {
            text-align: center;
            font-weight: bold;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <h2>上传图片</h2>
    <form action="photo_wall.php" method="post" enctype="multipart/form-data">
        <label for="theme">照片主题:</label><br>
        <input type="text" id="theme" name="theme" required><br><br>  <!-- 新增主题输入框 -->
        <label for="file">选择图片:</label><br>
        <input type="file" name="image" id="file" required><br><br>
        <input type="submit" name="submit" value="上传">
    </form>

    <h2>图片展示</h2>
    <div class="photo-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="photo-item">
                    <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="Image">
                    <div class="theme"><?php echo htmlspecialchars($row['theme']); ?></div> <!-- 显示主题 -->
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>没有找到任何图片。</p >
        <?php endif; ?>
    </div>
    </div>
        <br>
        <a href="index.php">返回主页</a >
    </div>

    <?php $conn->close(); ?>
</body>
</html>