<?php
include 'koneksi.php';
$conn = new mysqli("localhost", "root", "", "pertemuan2");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
$sql = "SELECT * FROM notes ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Catatan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .pastel-blue {
            background-color: #AEEEEE; /* Pastel blue color */
            padding: 20px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12 pastel-blue">
                <h2>Daftar Catatan</h2>
                <a href="pages/create.php" class="btn btn-primary">Tambah Catatan Baru</a>
                <br><br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Isi Catatan</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $no = 1;
                            // Looping data dari database
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . $row['judul'] . "</td>";
                                echo "<td>" . $row['isi'] . "</td>";
                                echo "<td>" . date('d-m-Y H:i', strtotime($row['created_at'])) . "</td>";
                                echo "<td>";
                                echo "<a href='./pages/edit.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a> ";
                                echo "<a href='./actions/delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah anda yakin ingin menghapus catatan ini?\");'>Hapus</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Belum ada catatan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
<?php
$conn->close();
?>
