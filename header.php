<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<head>
    <meta charset="UTF-8"> <!-- Hỗ trợ tiếng Việt -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOP DỤNG CỤ CẦU LÔNG SPORTS</title>
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<header>
    <a href="index.php">
        <img src="image/logo.png" alt="Logo" class="logo">
    </a>
    
    <h1 class="custom-title">GROUP1 SPORTS</h1>

    <form action="timkiem.php" method="get" class="search-bar">
        <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm...">
        <button type="submit">Tìm kiếm</button>
    </form>

    <?php
    //Hiển thị số sản phẩm bên cạnh biểu tượng giỏ hàng.

    $cartCount = 0;
    
    // Ưu tiên dùng cart_count nếu có (dữ liệu từ DB)
    if (isset($_SESSION['cart_count'])) {
        $cartCount = $_SESSION['cart_count'];
    }
    // Nếu chưa có, fallback dùng session['cart'] (giỏ tạm)
    elseif (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $qty) {
            $cartCount += $qty;
        }
    }
    ?>

    <div class="cart-icon-container">
        <a href="giohang.php">
            <img src="image/cart.png" id="Shopping-Cart" alt="Giỏ hàng">
            <p>Giỏ hàng</p>
            <span id="cart-count"><?php echo $cartCount; ?></span>
        </a>
    </div>

<div style="display: flex;">
<div class="dropdown1">
            <a href="#" class="dropdown1-btn"><i class="fas fa-bars"></i></a>
            <div class="dropdown1-content">
                <a class="active" href="thongtin/thongtincanhan.php">Thông tin cá nhân</a>
                <a href="donhang.php">Đơn mua</a>
                <a class="active" href="thongtin/doimatkhau.php">Đổi mật khẩu</a>
                <a href="logout.php">Đăng xuất</a>
            </div>
</div>

<div class="auth-buttons">
            <?php if (isset($_SESSION["username"])): ?>
                <span>Xin chào, <strong><?php echo htmlspecialchars($_SESSION["username"]); ?></strong></span>
            <?php else: ?>
                <a href="DangNhap.php">Đăng Nhập</a>
                <a href="DangKy.php">Đăng Ký</a>
            <?php endif; ?>
       
</div>
</div>


</header>


