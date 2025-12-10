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
            include 'db.php';

            $loai = isset($_GET['Loại']) ? (int)$_GET['Loại'] : 0;

            // PHÂN TRANG
            $limit = 9; // Số sản phẩm mỗi trang
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            if ($page < 1) $page = 1;
            $offset = ($page - 1) * $limit;

            // Đếm tổng sản phẩm theo loại
            $count_stmt = $conn->prepare("SELECT COUNT(*) as total FROM products WHERE Loại = ?");
            $count_stmt->bind_param("i", $loai);
            $count_stmt->execute();
            $count_result = $count_stmt->get_result();
            $total_row = $count_result->fetch_assoc();
            $total_products = $total_row['total'];
            $total_pages = ceil($total_products / $limit);

            // Lấy danh sách sản phẩm có phân trang
            $stmt = $conn->prepare("SELECT id, ten_san_pham, hinh_anh, gia, Giamgia FROM products WHERE Loại = ? LIMIT ?, ?");
            $stmt->bind_param("iii", $loai, $offset, $limit);
            $stmt->execute();
            $result = $stmt->get_result();

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

        <div class="sidebar">
          

            <!-- Phần sản phẩm bán chạy -->
            <div class="best-sellers">
                <h3>Sản Phẩm Bán Chạy</h3>
                <div class="best-sellers-products">
                    <?php
                    // Truy vấn sản phẩm bán chạy
                    include 'db.php';

                     $sql_best_sellers = "SELECT id, ten_san_pham, hinh_anh, gia, Giamgia FROM products ORDER BY luot_mua DESC LIMIT 3";
                    $result_best_sellers = $conn->query($sql_best_sellers);

                    // Kiểm tra nếu có sản phẩm bán chạy
                    if ($result_best_sellers->num_rows > 0) {
                        while ($row = $result_best_sellers->fetch_assoc()) {
                            echo "<a href = 'chitietsanpham.php?id=" . $row['id'] ."'<div class='product'>";
                            echo "<img src='image/" . htmlspecialchars($row['hinh_anh']) . "' alt='" . htmlspecialchars($row['ten_san_pham']) . "' width='200' height='200'>";
                            echo "<h4>" . htmlspecialchars($row['ten_san_pham']) . "</h4>";
                            if ($row['Giamgia'] > 0) {
                                echo "<span class='original-price'>" . number_format($row['gia'], 0, ',', '.') . " VND</span> ";
                                echo "<span class='price'>" . number_format($row['Giamgia'], 0, ',', '.') . " VND</span>";
                            } else {
                                echo "<p class='price'>Giá: " . number_format($row['gia'], 0, ',', '.') . " VND</p>";
                            }
                            echo "<div class='buttons'>";
                            // echo "<a href='chitietsanpham.php?id=" . $row['id'] . "' class='btn'>Chi tiết</a> ";
                            echo "<form method='post' action='cart.php' style='display:inline-block;'>
                    
                            <input type='hidden' name='product_id' value='" . $row['id'] . "'>
                            <input type='submit' class='btn' value='Thêm vào giỏ'>
                    
                            </form>";
                            echo "</div></a>";
                        }
                    } else {
                        echo "<p>Không có sản phẩm bán chạy nào.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?Loại=<?php echo $loai; ?>&page=<?php echo $page - 1; ?>">← Trước</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="?Loại=<?php echo $loai; ?>&page=<?php echo $i; ?>" <?php if ($i == $page) echo "class='active'"; ?>>
            <?php echo $i; ?>
        </a>
    <?php endfor; ?>

    <?php if ($page < $total_pages): ?>
        <a href="?Loại=<?php echo $loai; ?>&page=<?php echo $page + 1; ?>">Sau →</a>
    <?php endif; ?>
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
