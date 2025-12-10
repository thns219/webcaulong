<?php
session_start();
include 'db.php'; 

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    echo "<a href='DangNhap.php'>Vui lòng đăng nhập để xem giỏ hàng</a>";
    exit();
}

// Kiểm tra xem dữ liệu sản phẩm có được gửi qua POST không
if (isset($_POST['product_id'])) {  
    $user_id = intval($_SESSION['user_id']);
    $product_id = intval($_POST['product_id']); // Ép kiểu an toàn

    // Lấy số lượng người dùng muốn thêm, mặc định là 1 nếu không có
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    if ($quantity < 1) $quantity = 1;

    // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
    $check = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id");

    if (mysqli_num_rows($check) > 0) {
        // Nếu có rồi → tăng số lượng theo $quantity
        mysqli_query($conn, "UPDATE cart SET quantity = quantity + $quantity WHERE user_id = $user_id AND product_id = $product_id");
    } else {
        // Nếu chưa → thêm mới
        mysqli_query($conn, "INSERT INTO cart(user_id, product_id, quantity) VALUES($user_id, $product_id, $quantity)");
    }

    // Cập nhật lại tổng số sản phẩm trong giỏ hàng để hiển thị ở header
    $result = mysqli_query($conn, "SELECT SUM(quantity) AS total_quantity FROM cart WHERE user_id = $user_id");
    $row = mysqli_fetch_assoc($result);
    $_SESSION['cart_count'] = $row['total_quantity'] ?? 0;

    // Chuyển hướng trở lại trang trước (ví dụ chi tiết sản phẩm)
    header("Location: index.php?id=$product_id");
    exit();
} else {
    echo "Không nhận được thông tin sản phẩm cần thêm.";
}
?>
