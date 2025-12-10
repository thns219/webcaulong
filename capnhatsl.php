<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "Bạn cần đăng nhập.";
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['action']) && isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);

    // Lấy tồn kho
    $sql = "SELECT soluong FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);

    // Lấy số lượng hiện tại trong giỏ
    $sql_cart = "SELECT quantity FROM cart WHERE user_id = $user_id AND product_id = $product_id";
    $result_cart = mysqli_query($conn, $sql_cart);
    $cart = mysqli_fetch_assoc($result_cart);

    if ($_GET['action'] == 'increase' && $cart['quantity'] < $product['soluong']) {
        mysqli_query($conn, "UPDATE cart SET quantity = quantity + 1 WHERE user_id = $user_id AND product_id = $product_id");
    } elseif ($_GET['action'] == 'decrease' && $cart['quantity'] > 1) {
        mysqli_query($conn, "UPDATE cart SET quantity = quantity - 1 WHERE user_id = $user_id AND product_id = $product_id");
    }

    // Cập nhật lại session cart_count sau khi thay đổi
    $updateCount = mysqli_query($conn, "SELECT SUM(quantity) AS total FROM cart WHERE user_id = $user_id");
    $countRow = mysqli_fetch_assoc($updateCount);
    $_SESSION['cart_count'] = $countRow['total'] ?? 0;
}

header("Location: giohang.php");
exit();
?>
