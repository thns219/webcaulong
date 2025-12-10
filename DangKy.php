<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "caulong";

// Kết nối CSDL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = trim($_POST["email"]);
    $sdt = trim($_POST["sdt"]);
    $dia_chi = trim($_POST["dia_chi"]);
    $role_id = 3;

    if (empty($username) || empty($password) || empty($email) || empty($sdt) || empty($dia_chi)) {
        $error = "Vui lòng nhập đầy đủ thông tin.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email không hợp lệ.";
    } else {
        $sql = "INSERT INTO users (username, password, email, sdt, dia_chi, role_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $username, $password, $email, $sdt, $dia_chi, $role_id);

        if ($stmt->execute()) {
            $success = "Đăng ký thành công!";
        } else {
            $error = "Lỗi: " . $stmt->error;
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng ký</title>
     <style>
            body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.5)), url(https://media.gettyimages.com/id/2084534574/photo/yonex-all-england-open-badminton-championships-2024-day-3.jpg?s=2048x2048&w=gi&k=20&c=tEnYj-Mt8sw5D5aAeNiouoIH21qauXG6CwvsIfLw8dQ=) no-repeat;
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-container {
            background: rgba(250, 255, 0, 0.1);
            backdrop-filter: blur(5px);
            border: 2px solid #fff;
            border-radius: 30px;
            padding: 40px 30px;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .register-container h2 {
            color: #fff;
            margin-bottom: 5px;
        }

        .register-container input {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #b2ebf2;
            border-radius: 50px;
            font-size: 16px;
        }

        .register-container button {
            background: #00796b;
            color: white;
            border: none;
            padding: 15px;
            font-size: 16px;
            border-radius: 50px;
            cursor: pointer;
            width: 60%;
            margin-top: 20px;
        }

        .register-container button:hover {
            background: #004d40;
        }

        .error-notification {
            color: #fff;
            padding: 10px;
            border-radius: 30px;
            width: 80%;
            margin: 0 auto;
            text-align: center;
            background-color: rgba(255, 0, 0, 0.5);
        }

        .success-notification {
            color: #fff;
            padding: 10px;
            border-radius: 30px;
            width: 80%;
            margin: 0 auto;
            text-align: center;
            background-color: rgba(0, 255, 0, 0.5);
        }

        .register-container p {
            margin-top: 15px;
            font-size: 14px;
            color: #fff;
        }

        .register-container a {
            color: #fff;
        }   
        </style>
</head>

    <body>
        <div class="register-container">
            <h2>Đăng Ký Tài Khoản</h2>
            <form method="POST" action="">
                <input type="text" name="username" placeholder="Tên đăng nhập" 
                value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>" />
                
                <input type="password" name="password" placeholder="Mật khẩu" />

                <input type="email" name="email" placeholder="Email" 
                value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" />
                
                <input type="text" name="sdt" placeholder="Số điện thoại"
                value="<?= isset($_POST['sdt']) ? htmlspecialchars($_POST['sdt']) : '' ?>" />

                <input type="text" name="dia_chi" placeholder="Địa chỉ" 
                value="<?= isset($_POST['dia_chi']) ? htmlspecialchars($_POST['dia_chi']) : ''?>" />



                <?php if (!empty($error)) echo "<div class='error-notification'>$error</div>"; ?>
                <?php if (!empty($success)) echo "<div class='success-notification'>$success</div>"; ?>
                
                <button type="submit">Đăng Ký</button>
                <p>Đã có tài khoản? <a href="DangNhap.php">Đăng nhập</a></p>
            </form>
        </div>
    </body>
</html>
