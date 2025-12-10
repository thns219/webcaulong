<!-- donmua.php -->
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: DangNhap.php");
    exit();
}

include 'db.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT id, ngay_dat, trang_thai, tong_tien FROM don_hang WHERE user_id = ? ORDER BY ngay_dat DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đơn Mua</title>
    <link rel="stylesheet" href="csstest.css">
<style>
    html, body {
        height: 100%;
        margin: 0;
        background: linear-gradient(135deg, #e0f7fa, #e1bee7);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        
    }

    .container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 20px;
    }

    .container h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

    .orders-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
    }

    .order-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        transition: transform 0.3s ease;
    }

    .order-card:hover {
        transform: translateY(-6px);
    }

    .order-card h3 {
        margin: 0 0 12px;
        font-size: 20px;
        color: #444;
    }

    .order-info p {
        margin: 6px 0;
        color: #555;
        font-size: 15px;
    }

    .order-actions {
        margin-top: 16px;
        text-align: right;
    }

    .btn-view {
        padding: 10px 16px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    .btn-view:hover {
        background-color: #0056b3;
    }

    .no-order {
        text-align: center;
        font-style: italic;
        margin-top: 50px;
        font-size: 16px;
        color: #777;
    }
</style>

</head>
<body>
<?php include 'header.php'; ?>

<div class="container">
    <h2>Đơn hàng của bạn</h2>

    <?php if ($result->num_rows > 0): ?>
        <div class="orders-container">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="order-card">
                    <h3>Đơn hàng #<?php echo $row['id']; ?></h3>
                    <div class="order-info">
                        <p><strong>Ngày đặt:</strong> <?php echo date("d/m/Y H:i", strtotime($row['ngay_dat'])); ?></p>
                        <p><strong>Trạng thái:</strong> <?php echo $row['trang_thai']; ?></p>
                        <p><strong>Tổng tiền:</strong> <?php echo number_format($row['tong_tien'], 0, ',', '.'); ?>₫</p>
                    </div>
                    <div class="order-actions">
                        <a class="btn-view" href="chitiet_donhang.php?id=<?php echo $row['id']; ?>">Xem chi tiết</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="no-order">Bạn chưa có đơn hàng nào.</p>
    <?php endif; ?>
</div>
<div style="text-align: center">
            <a href="index.php" class="btn">⬅ Quay lại trang chủ</a>
        </div>
</body>
</html>
