<?php
session_start();
include 'db.php';

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Kết Quả Tìm Kiếm</title>
    <link rel="stylesheet" href="csstest.css">
</head>
<body>

<?php include 'header.php'; ?>
<div>
        <img src="image/slideshow_1.jpg" alt="bia" width="100%" height="250">
    </div>

    <nav>
        <a href="index.php">Trang Chủ</a>
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
        
        <a href="LienHe.html">Liên Hệ</a>
    </nav>


<h2 style="margin-left: 20px;">Kết quả tìm kiếm cho: <em><?= htmlspecialchars($keyword) ?></em></h2>

<div class="main-content">
    <div class="products">
        <?php
        if ($keyword !== '') {
            // Truy vấn sản phẩm có tên giống với từ khóa
            $sql = "SELECT * FROM products WHERE ten_san_pham LIKE ?";
            $stmt = $conn->prepare($sql);
            $like_keyword = '%' . $keyword . '%';
            $stmt->bind_param("s", $like_keyword);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product'>";
                    echo "<img src='image/" . htmlspecialchars($row['hinh_anh']) . "' alt='" . htmlspecialchars($row['ten_san_pham']) . "' width='200' height='200'>";
                    echo "<h3>" . htmlspecialchars($row['ten_san_pham']) . "</h3>";
                    echo "<p class='price'>Giá: " . number_format($row['gia'], 0, ',', '.') . " VND</p>";
                    echo "<div class='buttons'>";
                    echo "<a href='chitietsanpham.php?id=" . $row['id'] . "' class='btn'>Chi tiết</a> ";
                     echo "<form method='post' action='cart.php' style='display:inline-block;'>
        <input type='hidden' name='product_id' value='" . $row['id'] . "'>
        <input type='submit' class='btn' value='Thêm vào giỏ'>
      </form>";
                    echo "</div></div>";
                }
            } else {
                echo "<p>Không tìm thấy sản phẩm phù hợp.</p>";
            }

            $stmt->close();
        } else {
            echo "<p>Vui lòng nhập từ khóa để tìm kiếm.</p>";
        }
        ?>
    </div>
</div>

</body>
</html>
