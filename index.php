<?php
// Memanggil file-file kelas yang terpisah
require_once 'tiket.php';
require_once 'tiketReguler.php';
require_once 'tiketIMAX.php';
require_once 'tiketVelvet.php';
require_once 'koneksi.php';
// ==========================================
// KONEKSI DATABASE
// ==========================================
//$conn = new mysqli("localhost", "root", "", "db_latihan_pbo_trpl1a_nadya_shafa_a_a");
// if ($conn->connect_error) {
//     die("Koneksi gagal: " . $conn->connect_error);
// }

$result = $conn->query("SELECT * FROM tabel_tiket");
$data = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Dashboard</title>
    <style>
        :root { --primary: #6c5ce7; --bg: #f0f2f5; --card: #ffffff; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; display: flex; margin: 0; background: var(--bg); }
        .sidebar { width: 260px; background: #2d3436; height: 100vh; color: white; padding: 25px; position: fixed; box-sizing: border-box; }
        .sidebar h2 { margin-top: 0; }
        .sidebar a { display: block; color: #b2bec3; padding: 15px; text-decoration: none; border-radius: 8px; margin-bottom: 10px; transition: 0.3s; }
        .sidebar a:hover { background: var(--primary); color: white; }
        .content { margin-left: 260px; padding: 40px; width: calc(100% - 260px); box-sizing: border-box; }
        
        .grid-summary { display: flex; gap: 20px; margin-bottom: 40px; }
        .card { background: var(--card); padding: 20px; border-radius: 15px; flex: 1; text-align: center; box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
        .card h3 { text-transform: uppercase; color: #636e72; font-size: 0.9rem; margin-bottom: 5px; }
        
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.05); margin-bottom: 30px; }
        th { background: var(--primary); color: white; padding: 18px; text-transform: uppercase; font-size: 0.85rem; text-align: left; }
        td { padding: 15px; border-bottom: 1px solid #f1f1f1; text-align: left; vertical-align: middle; }
        tr:hover { background: #f9f9ff; }
        
        .badge { display: inline-block; padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: bold; background: #dfe6e9; color: #2d3436; text-transform: uppercase; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Cinema Dashboard</h2>
    <a href="?page=semua">📊 Ringkasan</a>
    <a href="?page=reguler">🎬 Studio Reguler</a>
    <a href="?page=imax">💎 Studio IMAX</a>
    <a href="?page=velvet">✨ Studio Velvet</a>
</div>

<div class="content">
    <?php
    $page = $_GET['page'] ?? 'semua';

    // --- BAGIAN RINGKASAN (Statistik + Semua Data) ---
    if ($page == 'semua') {
        echo "<h1>Dashboard Overview</h1>";
        echo "<div class='grid-summary'>";
        if (!empty($data)) {
            $counts = array_count_values(array_column($data, 'jenis_studio'));
            foreach ($counts as $s => $c) {
                echo "<div class='card'>";
                echo "<h3>Studio " . ucfirst($s) . "</h3>";
                echo "<p style='font-size:2.5rem; font-weight:bold; color:var(--primary); margin:0;'>$c</p><span>Tiket</span>";
                echo "</div>";
            }
        } else {
            echo "<div class='card'><h3>Data Kosong</h3><p>Belum ada data tiket.</p></div>";
        }
        echo "</div>";

        echo "<h1>Daftar Semua Tiket</h1>";
        echo "<table>";
        echo "<tr><th>No</th><th>Film</th><th>Jadwal</th><th>Studio</th><th>Info Fasilitas</th><th>Total Harga</th></tr>";
        
        $no = 1;
        if (!empty($data)) {
            foreach ($data as $row) {
                // Pembuatan objek disesuaikan dengan kelas dan kolom database
                $class = 'tiket' . ucfirst(strtolower($row['jenis_studio']));
                if (class_exists($class)) {
                    if ($row['jenis_studio'] == 'reguler') {
                        $obj = new $class($row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], $row['jumlah_kursi'], $row['harga_dasar_tiket'], $row['tipe_audio'], $row['lokasi_baris']);
                    } elseif ($row['jenis_studio'] == 'imax') {
                        $obj = new $class($row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], $row['jumlah_kursi'], $row['harga_dasar_tiket'], $row['kacamata_3d_id'], $row['efek_gerak_fitur']);
                    } else { // velvet
                        $obj = new $class($row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], $row['jumlah_kursi'], $row['harga_dasar_tiket'], $row['bantal_selimut_pack'], $row['layanan_butler']);
                    }

                    echo "<tr>
                        <td>{$no}</td>
                        <td><strong>".ucwords($row['nama_film'])."</strong></td>
                        <td>{$row['jadwal_tayang']}</td>
                        <td><span class='badge'>{$row['jenis_studio']}</span></td>
                        <td><em>{$obj->tampilkanInfoFasilitas()}</em></td>
                        <td style='font-weight:bold; color:var(--primary); white-space:nowrap;'>Rp " . number_format($obj->hitungTotalHarga(), 0, ',', '.') . "</td>
                    </tr>";
                    $no++;
                }
            }
        } else {
            echo "<tr><td colspan='6' style='text-align:center;'>Tidak ada data ditemukan.</td></tr>";
        }
        echo "</table>";

    } else {
        // --- BAGIAN STUDIO SPESIFIK ---
        echo "<h1>Studio " . ucfirst($page) . "</h1>";
        echo "<table>";
        echo "<tr><th>No</th><th>Film</th><th>Jadwal</th>";
        
        // Header kolom tabel dinamis berdasarkan tipe studio
        if ($page == 'reguler') {
            echo "<th>Tipe Audio</th><th>Lokasi Baris</th>";
        } elseif ($page == 'imax') {
            echo "<th>ID Kacamata 3D</th><th>Efek Gerak</th>";
        } else { // velvet
            echo "<th>Paket Bantal/Selimut</th><th>Layanan Butler</th>";
        }
        echo "<th>Total Harga</th></tr>";

        $no = 1;
        if (!empty($data)) {
            foreach ($data as $row) {
                if ($row['jenis_studio'] == $page) {
                    $class = 'tiket' . ucfirst(strtolower($page));
                    
                    if ($page == 'reguler') {
                        $obj = new $class($row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], $row['jumlah_kursi'], $row['harga_dasar_tiket'], $row['tipe_audio'], $row['lokasi_baris']);
                    } elseif ($page == 'imax') {
                        $obj = new $class($row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], $row['jumlah_kursi'], $row['harga_dasar_tiket'], $row['kacamata_3d_id'], $row['efek_gerak_fitur']);
                    } else { // velvet
                        $obj = new $class($row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], $row['jumlah_kursi'], $row['harga_dasar_tiket'], $row['bantal_selimut_pack'], $row['layanan_butler']);
                    }

                    // Menampilkan isi kolom fasilitas spesifik
                    $kolom1 = ($page == 'reguler') ? $row['tipe_audio'] : (($page == 'imax') ? $row['kacamata_3d_id'] : $row['bantal_selimut_pack']);
                    $kolom2 = ($page == 'reguler') ? $row['lokasi_baris'] : (($page == 'imax') ? $row['efek_gerak_fitur'] : $row['layanan_butler']);
                    
                    // Format nilai boolean (1/0) untuk paket/butler jika velvet
                    if ($page == 'velvet') {
                        $kolom1 = $kolom1 ? "Ya" : "Tidak";
                        $kolom2 = $kolom2 ? "Ya" : "Tidak";
                    }

                    echo "<tr>
                        <td>{$no}</td>
                        <td><strong>".ucwords($row['nama_film'])."</strong></td>
                        <td>{$row['jadwal_tayang']}</td>
                        <td>{$kolom1}</td>
                        <td>{$kolom2}</td>
                        <td style='font-weight:bold; color:var(--primary); white-space:nowrap;'>Rp " . number_format($obj->hitungTotalHarga(), 0, ',', '.') . "</td>
                    </tr>";
                    $no++;
                }
            }
        } else {
            echo "<tr><td colspan='6' style='text-align:center;'>Tidak ada data untuk studio ini.</td></tr>";
        }
        echo "</table>";
    }
    ?>
</div>

</body>
</html>
