<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$database = "test_db";

$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý khi bấm nút 'Nhập'
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ten = $_POST['ten'];
    $gioitinh = $_POST['gioitinh'];
    $ngaysinh = $_POST['ngaysinh'];

    // Thêm dữ liệu vào bảng
    $sql = "INSERT INTO nguoidung (ten, gioitinh, ngaysinh) VALUES ('$ten', '$gioitinh', '$ngaysinh')";
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>Dữ liệu đã được thêm thành công!</p>";
    } else {
        echo "<p style='color:red;'>Lỗi: " . $conn->error . "</p>";
    }
}

// Lấy dữ liệu từ bảng để hiển thị
$sql = "SELECT * FROM nguoidung";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập và Xuất Dữ Liệu</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Nhập và Xuất Dữ Liệu</h1>

    <form method="POST" action="">
        <label for="ten">Tên:</label>
        <input type="text" id="ten" name="ten" required><br><br>

        <label for="gioitinh">Giới tính:</label>
        <select id="gioitinh" name="gioitinh">
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
        </select><br><br>

        <label for="ngaysinh">Ngày sinh:</label>
        <input type="date" id="ngaysinh" name="ngaysinh" required><br><br>

        <button type="submit">Nhập</button>
    </form>

    <h2>Dữ Liệu Đã Nhập</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Giới tính</th>
                <th>Ngày sinh</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['ten'] . "</td>
                            <td>" . $row['gioitinh'] . "</td>
                            <td>" . $row['ngaysinh'] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Chưa có dữ liệu.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
