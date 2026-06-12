<?php
// Memanggil file kelas yang telah dibuat
require_once 'TiketReguler.php';
require_once 'TiketImax.php';
require_once 'TiketVelvet.php';

// Koneksi ke Database
$conn = new mysqli("localhost", "root", "", "db_latihan_pbo_trpl1a_nadya_shafa_a_a");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil Data
$query = "SELECT * FROM tabel_tiket";
$result = $conn->query($query);
$data_tiket = [];
while ($row = $result->fetch_assoc()) {
    $data_tiket[] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Tiket Bioskop</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { border: 1px solid #333; padding: 10px; text-align: left; }
        th { background-color: #333; color: white; }
    </style>
</head>
<body>

    <h1>Daftar Tiket Bioskop</h1>

    <?php
    $kategori = ['reguler', 'imax', 'velvet'];

    foreach ($kategori as $jenis) {
        echo "<h2>Studio " . ucfirst($jenis) . "</h2>";
        echo "<table>
                <tr>
                    <th>Film</th>
                    <th>Jadwal</th>
                    <th>Fasilitas Unik</th>
                    <th>Total Harga</th>
                </tr>";

        foreach ($data_tiket as $row) {
            if ($row['jenis_studio'] == $jenis) {
                // Instansiasi objek secara polimorfik
                $tiket = null;
                if ($jenis == 'reguler') {
                    $tiket = new TiketReguler($row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], $row['jumlah_kursi'], $row['harga_dasar_tiket'], $row['tipe_audio'], $row['lokasi_baris']);
                } elseif ($jenis == 'imax') {
                    $tiket = new TiketImax($row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], $row['jumlah_kursi'], $row['harga_dasar_tiket'], $row['kacamata_3d_id'], $row['efek_gerak_fitur']);
                } elseif ($jenis == 'velvet') {
                    $tiket = new TiketVelvet($row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], $row['jumlah_kursi'], $row['harga_dasar_tiket'], $row['bantal_selimut_pack'], $row['layanan_butler']);
                }

                // Menampilkan data menggunakan metode polimorfik
                echo "<tr>
                        <td>{$row['nama_film']}</td>
                        <td>{$row['jadwal_tayang']}</td>
                        <td>{$tiket->tampilkanInfoFasilitas()}</td>
                        <td>Rp " . number_format($tiket->hitungTotalHarga(), 0, ',', '.') . "</td>
                      </tr>";
            }
        }
        echo "</table>";
    }
    ?>

</body>
</html>