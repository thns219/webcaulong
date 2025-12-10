<?php
session_start();
include 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user["password"])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role_id'] = $user['role_id']; // Lưu role vào session
            // Gán role rõ ràng
            $role_map = [
                1 => 'admin',
                2 => 'manager',
                3 => 'user'
            ];
            // Gán vai trò vào session
            $_SESSION['role'] = $role_map[$user['role_id']] ?? 'guest';
            // ==== BỔ SUNG ĐỒNG BỘ GIỎ HÀNG ==== 
            $session_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
            $db_cart = [];
            $sql_cart = "SELECT product_id, quantity FROM cart WHERE user_id = ?";
            $stmt_cart = $conn->prepare($sql_cart);
            $stmt_cart->bind_param("i", $user['id']);
            $stmt_cart->execute();
            $result_cart = $stmt_cart->get_result();
            while ($row = $result_cart->fetch_assoc()) {
                $db_cart[$row['product_id']] = $row['quantity'];
            }
            $stmt_cart->close();

            foreach ($session_cart as $prod_id => $qty) {
                if (isset($db_cart[$prod_id])) {
                    $db_cart[$prod_id] = max($qty, $db_cart[$prod_id]);
                } else {
                    $db_cart[$prod_id] = $qty;
                }
            }

            $sql_del = "DELETE FROM cart WHERE user_id = ?";
            $stmt_del = $conn->prepare($sql_del);
            $stmt_del->bind_param("i", $user['id']);
            $stmt_del->execute();
            $stmt_del->close();

            $sql_insert = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            foreach ($db_cart as $prod_id => $qty) {
                $stmt_insert->bind_param("iii", $user['id'], $prod_id, $qty);
                $stmt_insert->execute();
            }
            $stmt_insert->close();

            //  CẬP NHẬT SESSION GIỎ HÀNG và cart_count
            $_SESSION['cart'] = $db_cart;
            $_SESSION['cart_count'] = array_sum($db_cart);

            // ==== XỬ LÝ GHI NHỚ TÀI KHOẢN VÀ MẬT KHẨU ====
            if (isset($_POST['remember'])) {
                setcookie("username", $username, [
                    "expires" => time() + (30 * 24 * 60 * 60),
                    "path" => "/",
                    "httponly" => true,
                    "samesite" => "Strict"
                ]);
                setcookie("password", $password, [
                    "expires" => time() + (30 * 24 * 60 * 60),
                    "path" => "/",
                    "httponly" => true,
                    "samesite" => "Strict"
                ]);
            } else {
                 // Xóa cookie nếu không chọn "Ghi nhớ"

                if (isset($_COOKIE['username'])) {
                    setcookie("username", "", time() - 3600, "/");
                }
                if (isset($_COOKIE['password'])) {
                    setcookie("password", "", time() - 3600, "/");
                }
            }
            // Chuyển hướng theo vai trò
            switch ($_SESSION['role']) {
                case 'admin':
                    header("Location: admin/index.php");
                    break;
                case 'manager':
                    header("Location: admin/index.php");
                    break;
                default:
                    header("Location: index.php");
            }
            exit;
        } else {
            $error = "Sai mật khẩu!";
        }
    } else {
        $error = "Tài khoản không tồn tại!";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập - GROUP1 SPORTS</title>
    <link rel="stylesheet" href="dangnhap.css">
</head>

<body>
    <form class="login-container" method="POST" action="">
        <h2>Đăng nhập tài khoản</h2>
        
        <input type="text" name="username" placeholder="Tên đăng nhập" required 
               value="<?php echo isset($_COOKIE['username']) ? htmlspecialchars($_COOKIE['username']) : ''; ?>">
        <input type="password" name="password" placeholder="Mật khẩu" required 
               value="<?php echo isset($_COOKIE['password']) ? htmlspecialchars($_COOKIE['password']) : ''; ?>">
        
        <div class="remember-btn">
            <input type="checkbox" name="remember" id="remember" <?php echo isset($_COOKIE['username']) && isset($_COOKIE['password']) ? 'checked' : ''; ?>>
            <label for="remember">Ghi nhớ tài khoản và mật khẩu</label>
        </div>

        <?php if (!empty($error)) echo "<div class='notification error-notification'>$error</div>"; ?>

        <button type="submit">Đăng nhập</button>
        <p>Chưa có tài khoản? <a href="DangKy.php">Đăng ký</a></p>
    </form>
</body>
</html>
