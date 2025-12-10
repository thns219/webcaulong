<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8"> <!-- Hỗ trợ tiếng Việt -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOP DỤNG CỤ CẦU LÔNG SPORTS</title>
    <link rel="stylesheet" href="csstest.css">
</head>

<body>
<?php include 'header.php'; ?>

    <div>
        <img src="image/slideshow_1.jpg" alt="bia" width="100%" height="250">
    </div>

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

    <div class="main-content">
        <div class="products">
            <?php
            // Kết nối cơ sở dữ liệu
            include 'db.php';

            // Truy vấn sản phẩm
            $sql = "SELECT id, ten_san_pham, hinh_anh, gia, Giamgia FROM products WHERE Giamgia > 0";
            $result = $conn->query($sql);


            // Kiểm tra nếu có sản phẩm
            if ($result->num_rows > 0) {
                echo "<div class='products'>";
                while ($row = $result->fetch_assoc()) {
                    echo "<a  class='product' href = 'chitietsanpham.php?id=" . $row['id'] ." ' ><div>";
                    echo "<img src='image/" . htmlspecialchars($row['hinh_anh']) . "' alt='" . htmlspecialchars($row['ten_san_pham']) . "' width='200' height='200'>";
                    echo "<h3>" . htmlspecialchars($row['ten_san_pham']) . "</h3>";
                    if ($row['Giamgia'] > 0) {
                        echo "<span class='original-price'>" . number_format($row['gia'], 0, ',', '.') . " VND</span> ";
                        echo "<span class='price'>" . number_format($row['Giamgia'], 0, ',', '.') . " VND</span>";
                    } else {
                        echo "<span class='price'>Giá: " . number_format($row['gia'], 0, ',', '.') . " VND</span>";
                    }
                    
                    echo "<div class='buttons'>";
                    // echo "<a href='chitietsanpham.php?id=" . $row['id'] . "' class='btn'>Chi tiết</a> ";
                    echo "<form method='post' action='cart.php' style='display:inline-block;'>
                    
                    <input type='hidden' name='product_id' value='" . $row['id'] . "'>
                    <input type='submit' class='btn' value='Thêm vào giỏ'>
                    
                    </form>"
                    
                    ;
                    
                    echo "</div>";
                    
                    echo "</div>";
                    echo "</a>";
                }
                echo "</div>";
            } else {
                echo "Không có sản phẩm nào.";
            }
            ?>
        </div>

       
    </div>
       <div class="news-section">
        <h2>Tin Tức Mới Nhất</h2>

            <?php
                

                $sql_news = "SELECT id, title, thumbnail, summary FROM posts";

                $result_news = $conn->query($sql_news);

                // Kiểm tra nếu có sản phẩm bán chạy
                if ($result_news->num_rows > 0) {
                    while ($row = $result_news->fetch_assoc()) {
                        echo "<a href='tintuc.php?id=" . $row['id'] . "' ><div class='news-item'>";
                        echo "<img src='" . htmlspecialchars($row['thumbnail']) . "' width='240' height='200'>";
                        echo "<div>";
                        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                        
                        echo "<p>" . htmlspecialchars($row['summary']) . "</p>";
                        // echo "<a href='tintuc.php?id=" . $row['id'] . "' class='btn'>Xem chi tiết</a>";
                        echo "</div>";
                        echo "</div></a>";
                    }
                } else {
                    echo "<p>Không có sản phẩm bán chạy nào.</p>";
                }
            ?>
        
    </div>

   
    

<?php include 'footer.php'; ?>

</body>

</html>
