<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thanh toán - GROUP1 SPORTS</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #e2e8f0, #f3f4f6);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .checkout-container {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 90%;
            text-align: center;
        }

        .checkout-container h2 {
            color: #1e3a8a;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .message {
            font-size: 18px;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
        }

        .error {
            background-color: #fee2e2;
            color: #b91c1c;
            border: 1px solid #ef4444;
            text-align: left;
        }

        a.button {
            display: inline-block;
            padding: 12px 25px;
            background-color: #2563eb;
            color: white;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        a.button:hover {
            background-color: #1e40af;
        }
    </style>
</head>
<body>
<div class="checkout-container">
    <h2>Kết quả thanh toán</h2>

    <?php
    if (!isset($_SESSION['user_id'])) {
        echo '<div class="message error">❌ Bạn cần đăng nhập để thanh toán.</div>';
        exit();
    }

    $user_id = $_SESSION['user_id'];

    // Lấy thông tin user
    $sql_user = "SELECT username, sdt, dia_chi FROM users WHERE id = $user_id";
    $res_user = mysqli_query($conn, $sql_user);
    if ($res_user && mysqli_num_rows($res_user) > 0) {
        $user_data = mysqli_fetch_assoc($res_user);
        $username = $user_data['username'];
        $sdt = $user_data['sdt'];
        $dia_chi = $user_data['dia_chi'];
    } else {
        echo '<div class="message error">❌ Không tìm thấy thông tin người dùng.</div>';
        exit;
    }

    // Lấy sản phẩm trong giỏ hàng
    $sql = "SELECT cart.product_id, cart.quantity, products.soluong 
            FROM cart 
            JOIN products ON cart.product_id = products.id 
            WHERE cart.user_id = $user_id";
    $result = mysqli_query($conn, $sql);

    $can_checkout = true;
    $cart_items = [];
    $error_list = "";

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['quantity'] > $row['soluong']) {
            $can_checkout = false;
            $error_list .= "❌ Sản phẩm ID <strong>{$row['product_id']}</strong> không đủ số lượng trong kho.<br>";
        }
        $cart_items[] = $row;
    }

    if (!$can_checkout) {
        echo '<div class="message error">' . $error_list . '</div>';
        echo '<a class="button" href="giohang.php">Quay lại giỏ hàng</a>';
        exit;
    }

    // Tính tổng tiền
   $tong_tien = 0;
    $cart_products = [];

    foreach ($cart_items as $item) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];

        $res = mysqli_query($conn, "SELECT gia, Giamgia FROM products WHERE id = $product_id");
        $row = mysqli_fetch_assoc($res);
        $gia = $row['gia'];
        if ($row['Giamgia'] > 0) {
            $gia = $row['Giamgia'];
        }

        $tong_tien += $gia * $quantity;

        $cart_products[] = [
            'product_id' => $product_id,
            'quantity' => $quantity,
            'don_gia' => $gia
        ];
    }

    mysqli_begin_transaction($conn);

    try {
        // Lưu đơn hàng
        $stmt = mysqli_prepare($conn, "INSERT INTO don_hang (user_id, username, sdt, dia_chi, tong_tien) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "isssd", $user_id, $username, $sdt, $dia_chi, $tong_tien);
        mysqli_stmt_execute($stmt);
        $don_hang_id = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt);

        // Lưu chi tiết đơn hàng
        $stmt = mysqli_prepare($conn, "INSERT INTO chi_tiet_don_hang (don_hang_id, product_id, so_luong, don_gia) VALUES (?, ?, ?, ?)");
        foreach ($cart_products as $prod) {
            mysqli_stmt_bind_param($stmt, "iiid", $don_hang_id, $prod['product_id'], $prod['quantity'], $prod['don_gia']);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);

        // Cập nhật kho và lượt mua
        foreach ($cart_items as $item) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];
            $new_stock = $item['soluong'] - $quantity;

            mysqli_query($conn, "UPDATE products SET soluong = $new_stock WHERE id = $product_id");
            mysqli_query($conn, "UPDATE products SET luot_mua = luot_mua + $quantity WHERE id = $product_id");
        }

        //  Xóa giỏ hàng
        mysqli_query($conn, "DELETE FROM cart WHERE user_id = $user_id");

        //  Cập nhật số lượng giỏ hàng về 0 trong session
        $_SESSION['cart_count'] = 0;

        // Commit
        mysqli_commit($conn);

        echo '<div class="message success">✅ Thanh toán thành công!</div>';
        echo '<a class="button" href="index.php">Tiếp tục mua hàng</a> ';
        echo '<a class="button" href="chitiet_donhang.php?id=' . $don_hang_id . '">Xem chi tiết đơn hàng</a>';

    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo '<div class="message error">❌ Lỗi trong quá trình đặt hàng: ' . $e->getMessage() . '</div>';
        echo '<a class="button" href="giohang.php">Quay lại giỏ hàng</a>';
    }
    ?>
</div>
</body>
<!-- Confetti & Ting Sound -->
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
<script>
    function playTingSound() {
        const audio = new Audio("https://www.myinstants.com/media/sounds/mario-coin.mp3");
        audio.play();
    }

    function fireConfetti() {
        confetti({
            particleCount: 300,
            spread: 120,
            startVelocity: 40,
            scalar: 1.5,
            origin: { y: 0.6 }
        });
    }

    <?php if (isset($don_hang_id)) : ?>
        setTimeout(() => {
            fireConfetti();
            playTingSound();
        }, 500);
    <?php endif; ?>
</script>
</html>
