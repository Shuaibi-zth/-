<?php
// 引入数据库连接文件
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>东财数智小小论坛</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #0073e6;
            font-size: 2.5rem;
        }

        .section h2 {
            font-size: 2rem;
            color: #444;
            text-align: center;
            margin-bottom: 40px;
        }

        .intro {
            text-align: center;
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 20px;
        }

        /* 调整按钮大小与间隔 */
        a {
            display: block;
            width: 60%;
            text-decoration: none;
            color: #fff;
            background-color: #0073e6;
            padding: 25px;
            border-radius: 10px;
            font-size: 1.5rem;
            margin: 40px auto; /* 间隔为15px */
            text-align: center;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #005bb5;
        }

        /* 按钮容器样式 */
        .button-group {
            display: flex;
            flex-direction: column;
            align-items: center; /* 居中对齐 */
        }

        /* 调整页面的底部设计 */
        footer {
            text-align: center;
            padding: 20px;
            background-color: #0073e6;
            color: #fff;
            margin-top: 30px;
            border-radius: 0 0 8px 8px;
        }

        footer a {
            color: #fff;
            text-decoration: underline;
        }

        footer a:hover {
            text-decoration: none;
        }
          /* 添加版主声明样式 */
          .moderator {
            margin-top: 15px;
            font-size: 1rem;
            color: #fff;
            text-align: center;
        }


    </style>
</head>
<body>

    <div class="container">
        <h1>东财数智小小论坛</h1>

        <div class="section">
            <h2>功能板块</h2>
            <div class="button-group">

                <!-- 论坛主体 -->
                <div class="intro">数智论坛：专属于数智学院的大家交流讨论的空间。数智er help 数智er,让信息的传递更具针对性吧！</div>
                <a href="forum.php">--->进入论坛<---
                </a >
                <!-- 大众点评 -->
                <div class="intro">大众点评：点评学校食堂的餐厅，对东财食堂尽情的指手画脚吧！（因为作者是个吃货所以设立了这个板块QAQ）</div>
                <a href="reviews.php">--->大众点评<---
                </a >

                <!-- 照片墙 -->
                <div class="intro">照片墙：专属于数智学院的照片留档，让我们的记忆在这里留存下来吧！</div>
                <a href="photo_wall.php">---->照片墙<----
                </a >
            </div>
        </div>
    </div>

    <footer>
        <p>© 2024 东财数智小小论坛. All rights reserved. | 主页</p >
             <!-- 版主声明 -->
        <p class="moderator">版主: Shuaibi</p > <!-- 这里声明版主为XXX -->
    </footer>

</body>
</html>