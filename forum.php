<?php
// 如果是POST请求，处理留言
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nickname = htmlspecialchars($_POST['nickname']);
    $message = htmlspecialchars($_POST['message']);
    $ip = $_SERVER['REMOTE_ADDR'];

    // 保存留言到文件
    $file = 'forum_messages.txt';
    $entry = date('Y-m-d H:i:s') . " - " . $nickname . " (" . $ip . ") : " . $message . "\n";
    file_put_contents($file, $entry, FILE_APPEND);
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>论坛主体 - 东财数智小小论坛</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to right, #4facfe, #00f2fe); /* 渐变背景 */
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 600px;
        }

        h1 {
            color: #0073e6;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        input[type="submit"] {
            background-color: #0073e6;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2rem;
        }

        input[type="submit"]:hover {
            background-color: #005bb5;
        }

        h2 {
            margin-top: 30px;
            color: #333;
        }

        .message-board {
            text-align: left;
            max-height: 300px;
            overflow-y: auto;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .message-board p {
            margin: 5px 0;
            padding: 5px;
            background-color: #fff;
            border-radius: 3px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>论坛主体</h1>
        <form action="forum.php" method="POST">
            昵称: <input type="text" name="nickname" required><br>
            留言: <textarea name="message" required></textarea><br>
            <input type="submit" value="提交留言">
        </form>

        <h2>留言板</h2>
        <div class="message-board">
            <?php
            if (file_exists('forum_messages.txt')) {
                echo nl2br(file_get_contents('forum_messages.txt'));
            }
            ?>
        </div>
        <br>
        <a href="index.php">返回主页</a >
    </div>

</body>
</html>