<?php
session_start();
include 'db.php';

if (!isset($_GET['id'])) {
    echo "Không có ID đơn hàng.";
    exit;
}

$don_hang_id = intval($_GET['id']);

// Lấy thông tin đơn hàng, bao gồm user_id và ngày đặt
$sql_order = "SELECT don_hang.*, users.username, users.sdt, users.dia_chi 
              FROM don_hang 
              JOIN users ON don_hang.user_id = users.id 
              WHERE don_hang.id = $don_hang_id";

$result_order = mysqli_query($conn, $sql_order);
if (mysqli_num_rows($result_order) == 0) {
    echo "Đơn hàng không tồn tại.";
    exit;
}

$order = mysqli_fetch_assoc($result_order);

// Lấy chi tiết sản phẩm trong đơn hàng
$sql_items = "SELECT chi_tiet_don_hang.*, products.ten_san_pham, products.hinh_anh 
              FROM chi_tiet_don_hang 
              JOIN products ON chi_tiet_don_hang.product_id = products.id 
              WHERE chi_tiet_don_hang.don_hang_id = $don_hang_id";

$result_items = mysqli_query($conn, $sql_items);

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết đơn hàng #<?php echo $don_hang_id; ?></title>
       <style>
        html, body {
            height: 100%;
            background: linear-gradient(135deg, #e0f7fa, #e1bee7);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 920px;
            margin: 40px auto;
            padding: 0 20px;
        }

        h1, h2 {
            color: #333;
            text-align: center;
        }

        .order-info, .products-table {
            background: white;
            padding: 20px;
            border-radius: 16px;
            margin-bottom: 30px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }

        .products-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .products-table th, .products-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .products-table th {
            background-color: #007bff;
            color: white;
        }

        img {
            object-fit: cover;
            border-radius: 8px;
        }

        .button {
            display: block;
            width: 220px;
            margin: 0 auto 40px;
            padding: 12px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h1>Chi tiết đơn hàng #<?php echo $don_hang_id; ?></h1>
   
    

    <div class="order-info">
        <h2>Thông tin khách hàng</h2>
        <p><strong>Tên:</strong> <?php echo htmlspecialchars($order['username']); ?></p>
        <p><strong>Số điện thoại:</strong> <?php echo htmlspecialchars($order['sdt']); ?></p>
        <p><strong>Địa chỉ:</strong> <?php echo htmlspecialchars($order['dia_chi']); ?></p>
        <p><strong>Ngày đặt hàng:</strong> <?php echo $order['ngay_dat']; ?></p>
        <p><strong>Tổng tiền:</strong> <?php echo number_format($order['tong_tien'], 0, ',', '.') . " đ"; ?></p>
    </div>

    <div class="products-table">
        <h2>Danh sách sản phẩm</h2>
        <table>
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá (VNĐ)</th>
                    <th>Thành tiền (VNĐ)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($item = mysqli_fetch_assoc($result_items)) {
                    $thanh_tien = $item['so_luong'] * $item['don_gia'];
                    echo "<tr>";
                     echo "<td><img src='image/" . htmlspecialchars($item['hinh_anh']) . "' alt='Ảnh sản phẩm' width='80' height='80' style='object-fit: cover; border-radius: 8px;'></td>";
                    echo "<td>" . htmlspecialchars($item['ten_san_pham']) . "</td>";
                    echo "<td>" . $item['so_luong'] . "</td>";
                    echo "<td>" . number_format($item['don_gia'], 0, ',', '.') . "</td>";
                    echo "<td>" . number_format($thanh_tien, 0, ',', '.') . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

     <a class="button" href="index.php">Trở về trang chính</a>

</body>
</html>
