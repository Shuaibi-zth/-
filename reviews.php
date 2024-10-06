<?php
// 如果是POST请求，处理餐厅点评
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $restaurant = htmlspecialchars($_POST['restaurant']);
    $review = htmlspecialchars($_POST['review']);

    // 保存点评到文件
    $file = 'reviews.txt';
    $entry = date('Y-m-d H:i:s') . " - " . $restaurant . " : " . $review . "\n";
    file_put_contents($file, $entry, FILE_APPEND);
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>大众点评 - 东财数智小小论坛</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to right, #0073e6, #6a11cb); /* 从蓝色到紫色的渐变背景 */
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

        .review-board {
            text-align: left;
            max-height: 300px;
            overflow-y: auto;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .review-board p {
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
        <h1>大众点评</h1>
        <form action="reviews.php" method="POST">
            餐厅名称: <input type="text" name="restaurant" required><br>
            评价: <textarea name="review" required></textarea><br>
            <input type="submit" value="提交评价">
        </form>

        <h2>餐厅点评</h2>
        <div class="review-board">
            <?php
            if (file_exists('reviews.txt')) {
                echo nl2br(file_get_contents('reviews.txt'));
            }
            ?>
        </div>
        <br>
        <a href="index.php">返回主页</a >
    </div>

</body>
</html>