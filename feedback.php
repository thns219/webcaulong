<?php 
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'] ?? 0;
   
    $sao = intval($_POST['sao']);
    $noi_dung = mysqli_real_escape_string($conn, $_POST['noi_dung']);
    // Chèn dữ liệu vào bảng feedback
    $sql = "INSERT INTO feedback (user_id, sao, noi_dung, ngay) 
            VALUES ($user_id, $sao, '$noi_dung', NOW())";
    mysqli_query($conn, $sql);
    $success = "Cảm ơn bạn đã đánh giá!";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đánh giá Shop</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        max-width: 700px;
        margin: 30px auto;
        padding: 20px;
        background: linear-gradient(to right, #e0f7fa, #fdfdfd);
        color: #333;
    }

    h2 {
        text-align: center;
        color: #0056b3;
        font-size: 28px;
        margin-bottom: 25px;
    }

    form {
        background: #fff;
        padding: 25px 30px;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    textarea {
        width: 100%;
        height: 120px;
        padding: 12px;
        margin: 20px 0;
        border-radius: 10px;
        border: 1px solid #ccc;
        font-size: 15px;
        resize: vertical;
        transition: border 0.3s;
    }

    textarea:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0,123,255,0.3);
    }

    .stars {
        direction: rtl;
        unicode-bidi: bidi-override;
        text-align: center;
        margin-bottom: 20px;
    }

    .stars input[type=radio] {
        display: none;
    }

    .stars label {
        font-size: 2.4em;
        color: #ccc;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .stars input:checked ~ label,
    .stars label:hover,
    .stars label:hover ~ label {
        color: #ffc107;
    }

    button, .btn {
        display: inline-block;
        padding: 12px 24px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        margin: 10px 10px 0 0;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s;
    }

    .btn:hover, button:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .button-group {
        text-align: center;
        margin-top: 10px;
    }

    .success {
        text-align: center;
        color: #28a745;
        font-size: 17px;
        margin-top: 20px;
        font-weight: 500;
    }
</style>

</head>
<body>

    <h2>Đánh giá chất lượng Shop</h2>

    <?php if (!empty($success)) echo "<p class='success'>$success</p>"; ?>

    <form method="POST">
        <div class="stars">
            <input type="radio" name="sao" id="star5" value="5"><label for="star5">★</label>
            <input type="radio" name="sao" id="star4" value="4"><label for="star4">★</label>
            <input type="radio" name="sao" id="star3" value="3"><label for="star3">★</label>
            <input type="radio" name="sao" id="star2" value="2"><label for="star2">★</label>
            <input type="radio" name="sao" id="star1" value="1"><label for="star1">★</label>
        </div>

        <textarea name="noi_dung" placeholder="Viết đánh giá của bạn..."></textarea>

        <!-- Thêm input ẩn chứa product_id -->
        <input type="hidden" name="product_id" value="<?= htmlspecialchars($_GET['id'] ?? '') ?>">

        <div class="button-group">
            <a href="index.php" class="btn">← Quay lại trang chủ</a>
            <button type="submit" class="btn">Gửi đánh giá</button>
        </div>
    </form>

</body>
</html>
