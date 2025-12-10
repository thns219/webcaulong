<?php
// Kết nối cơ sở dữ liệu
include 'db.php';
session_start();

// Lấy id từ URL và kiểm tra tồn tại
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Tránh SQL Injection
$stmt = $conn->prepare("SELECT id, title, author, published_date, content FROM posts WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$news = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="csstest.css">
</head>
<body>
    
    <?php
        
        include "header.php"
    ?>
    <nav>
        <a href="index.php">Trang Chủ</a>
        <a href="admin\index.php">Trang quản trị</a>

       <div class="dropdown">
            <a href="#" class="dropdown-btn">Sản Phẩm <span class="arrow">&#9662;</span></a>
            <div class="dropdown-content">
                <a href="loaisanpham.php?Loại=3">Giày Cầu Lông</a>
                <a href="loaisanpham.php?Loại=1">Áo Cầu Lông</a>
                <a href="loaisanpham.php?Loại=2">Vợt Cầu Lông</a>
                <a href="loaisanpham.php?Loại=4">Phụ Kiện</a>
            </div>
        </div>
        <a href="KhuyenMai.php">Khuyến Mại</a>
       
        <a href="feedback.php">Đánh Giá Shop</a>
    </nav>

    <div class="svgun">
        <?php if ($news): ?>
            <h1><?= htmlspecialchars($news["title"])?></h1>
            <p><span>Tác giả: <?= htmlspecialchars($news["author"]) ?></span></p>
            <p><span>Ngày đăng: <?= htmlspecialchars($news["published_date"]) ?></span></p>
            <p><?= $news["content"] ?></p>
    </div>

    <?php endif; ?>

    <?php include 'footer.php'; ?>

</body>

<style>
 

    body {
        font-family: 'Segoe UI', Roboto, sans-serif;
        background-color: #eef2f5; /* nền tổng thể nhạt hiện đại */
        color: #333;
        line-height: 1.6;
    }


    .svgun {
        max-width: 900px;
        background-color: #fff;
        margin: 40px auto;
        padding: 40px 50px;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        animation: fadeIn 0.5s ease-in-out;
    }

    .svgun h1 {
        font-size: 32px;
        color: #1e88e5;
        margin-bottom: 10px;
    }

    .svgun span {
        display: inline-block;
        color: #888;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .svgun p {
        font-size: 18px;
        margin: 20px 0;
        line-height: 1.8;
    }

    .svgun img {
        display: block;
        margin: 20px auto;
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

  
    
</style>




</html>