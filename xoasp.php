<?php
session_start();
include 'db.php';

//  Kiểm tra người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    echo "Bạn phải đăng nhập để thực hiện thao tác này.";
    exit();
}

$user_id = $_SESSION['user_id'];

//  Lấy product_id từ URL
if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);

    //  Xóa sản phẩm khỏi giỏ hàng của đúng user
    $delete = mysqli_query($conn, "DELETE FROM cart WHERE user_id = $user_id AND product_id = $product_id");

    if ($delete) {
        //  Cập nhật lại số lượng sản phẩm trong session
        $result = mysqli_query($conn, "SELECT SUM(quantity) AS total_quantity FROM cart WHERE user_id = $user_id");
        $row = mysqli_fetch_assoc($result);
        $_SESSION['cart_count'] = $row['total_quantity'] ?? 0;

        header("Location: giohang.php");
        exit();
    } else {
        echo "Xóa sản phẩm thất bại.";
    }
} else {
    echo "Không tìm thấy sản phẩm cần xóa.";
}
?>
