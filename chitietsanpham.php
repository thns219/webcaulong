<?php 
include 'db.php';
session_start();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $conn->prepare("SELECT id, ten_san_pham, hinh_anh, gia, mo_ta, Giamgia FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="csstest.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f0f4f8, #ffffff);
            color: #1f2937;
        }

        nav {
            margin: 10px 25px;
        }
        
        .product-detail {
            max-width: 1000px;
            margin: 40px auto;
            padding: 40px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            display: flex;
            gap: 40px;
            align-items: flex-start;
            animation: fadeIn 0.5s ease-in-out;
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

        .product-detail img {
            width: 100%;
            max-width: 350px;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .product-info {
            flex: 1;
        }

        .product-info h1 {
            font-size: 32px;
            font-weight: bold;
            color: #1d4ed8;
            margin-bottom: 20px;
        }

        .price {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 22px;
            margin: 20px 0;
        }

        .original-price {
            text-decoration: line-through;
            color: #9ca3af;
        }

        .sale-price {
            color: #ef4444;
            font-weight: bold;
            font-size: 26px;
        }

        .product-info p {
            font-size: 17px;
            line-height: 1.7;
            color: #374151;
            margin-bottom: 30px;
        }

        .product-info form {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .product-info form label {
            font-weight: 600;
        }

        .product-info form input[type="number"] {
            width: 30px;
            padding: 6px;
            text-align: center;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 16px;
        }

        .product-info form button[type="button"] {
            padding: 6px 12px;
            background-color: #e5e7eb;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            font-weight: 600;
        }

        .product-info form button[type="button"]:hover {
            background-color: #cbd5e1;
        }

        .product-info .btn {
            padding: 10px 24px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            font-size: 16px;
            transition: background 0.3s ease;
            cursor: pointer;
        }

        .product-info .btn:hover {
            background: #1e3a8a;
        }

        .product-info .back-btn {
            padding: 8px 24px;
            background: #6b7280;
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        .product-info .back-btn:hover {
            background: #4b5563;
        }

        #total-price {
            font-weight: bold;
            color: #1d4ed8;
            font-size: 20px;
            margin-bottom: 1px;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

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


<div class="product-detail">
        <?php if ($product): ?>
            <img src="image/<?= htmlspecialchars($product['hinh_anh']) ?>" 
                alt="<?= htmlspecialchars($product['ten_san_pham']) ?>">

            <div class="product-info">
                <h1><?= htmlspecialchars($product['ten_san_pham']) ?></h1>

                <p class="price">
                    <?php 
                        $gia = $product['gia'];
                        if ($product['Giamgia'] > 0) {
                            $gia = $product['Giamgia'];
                            echo '<span class="original-price">' . number_format($product['gia'], 0, ',', '.') . ' VND </span>';
                        }
                    ?>
                    
                        <span class="sale-price"><?= number_format($gia, 0, ',', '.') ?> VND</span>
                        
                </p>

                <p><?= nl2br(htmlspecialchars($product['mo_ta'])) ?></p>

                <form action="cart.php" method="post">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                    <label for="quantity">Số lượng:</label>
                    <button type="button" onclick="decreaseQuantity()">-</button>
                    <input type="number" id="quantity" name="quantity" value="1" min="1">
                    <button type="button" onclick="increaseQuantity()">+</button>

                    <input type="submit" class="btn" value="Thêm vào giỏ">
                    <a href="index.php" class="back-btn">Quay lại</a>
                    <p class="price">Tổng tiền: <span id="total-price"><?= number_format($gia, 0, ',', '.') ?> VND</span></p>
                    
                </form>



                <script>
                    const pricePerItem = <?= $gia ?>;
                    const quantityInput = document.getElementById('quantity');
                    const totalPriceElement = document.getElementById('total-price');

                    function updateTotal() {
                        const quantity = parseInt(quantityInput.value);
                        const total = pricePerItem * quantity;
                        totalPriceElement.textContent = total.toLocaleString('vi-VN') + ' VND';
                    }

                    function decreaseQuantity() {
                        if (parseInt(quantityInput.value) > 1) {
                            quantityInput.value = parseInt(quantityInput.value) - 1;
                            updateTotal();
                        }
                    }

                    function increaseQuantity() {
                        quantityInput.value = parseInt(quantityInput.value) + 1;
                        updateTotal();
                    }

                    quantityInput.addEventListener('input', updateTotal); // Cập nhật nếu người dùng nhập tay
                </script>
            </div>
    <?php else: ?>
        <h2>Không tìm thấy sản phẩm.</h2>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
