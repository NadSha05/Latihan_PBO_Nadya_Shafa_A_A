<?php
// Kelas-kelas (Digabung agar menjadi 1 file)
class Tiket {
    protected $id, $film, $jadwal, $kursi, $harga;
    public function __construct($id, $film, $jadwal, $kursi, $harga) {
        $this->id = $id; $this->film = $film; $this->jadwal = $jadwal;
        $this->kursi = $kursi; $this->harga = $harga;
    }
}
class TiketReguler extends Tiket { public function hitungTotalHarga() { return $this->kursi * $this->harga; } }
class TiketImax extends Tiket { public function hitungTotalHarga() { return ($this->kursi * $this->harga) + 35000; } }
class TiketVelvet extends Tiket { public function hitungTotalHarga() { return ($this->kursi * $this->harga) + 50000; } }

// Koneksi
$conn = new mysqli("localhost", "root", "", "db_latihan_pbo_trpl1a_nadya_shafa_a_a");
$data = $conn->query("SELECT * FROM tabel_tiket")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <style>
        :root { --primary: #6c5ce7; --bg: #f0f2f5; --card: #ffffff; }
        body { font-family: 'Segoe UI', sans-serif; display: flex; margin: 0; background: var(--bg); }
        .sidebar { width: 260px; background: #2d3436; height: 100vh; color: white; padding: 25px; position: fixed; }
        .sidebar a { display: block; color: #b2bec3; padding: 15px; text-decoration: none; border-radius: 8px; margin-bottom: 10px; transition: 0.3s; }
        .sidebar a:hover { background: var(--primary); color: white; }
        .content { margin-left: 300px; padding: 40px; width: 100%; }
        
        .grid-summary { display: flex; gap: 20px; margin-bottom: 40px; }
        .card { background: var(--card); padding: 20px; border-radius: 15px; flex: 1; text-align: center; box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
        
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.05); margin-bottom: 30px; }
        th { background: var(--primary); color: white; padding: 18px; text-transform: uppercase; font-size: 0.85rem; text-align: left; }
        td { padding: 15px; border-bottom: 1px solid #f1f1f1; text-align: left; }
        tr:hover { background: #f9f9ff; }
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
        echo "<h1>Dashboard Overview</h1><div class='grid-summary'>";
        $counts = array_count_values(array_column($data, 'jenis_studio'));
        foreach ($counts as $s => $c) echo "<div class='card'><h3>$s</h3><p style='font-size:2rem; color:var(--primary)'>$c</p> Tiket</div>";
        echo "</div>";

        echo "<h1>Daftar Semua Tiket</h1>";
        echo "<table><tr><th>No</th><th>Film</th><th>Jadwal</th><th>Studio</th><th>Total Harga</th></tr>";
        $no = 1;
        foreach ($data as $row) {
            $class = 'Tiket' . ucfirst($row['jenis_studio']);
            $obj = new $class(1, '', '', 1, $row['harga_dasar_tiket']);
            echo "<tr><td>{$no}</td><td>{$row['nama_film']}</td><td>{$row['jadwal_tayang']}</td><td>" . ucfirst($row['jenis_studio']) . "</td><td style='font-weight:bold; color:var(--primary)'>Rp " . number_format($obj->hitungTotalHarga(), 0, ',', '.') . "</td></tr>";
            $no++;
        }
        echo "</table>";

    } else {
        // --- BAGIAN STUDIO SPESIFIK ---
        echo "<h1>Studio " . ucfirst($page) . "</h1>";
        echo "<table><tr><th>No</th><th>Film</th><th>Jadwal</th>";
        
        // Header dinamis
        if ($page == 'reguler') echo "<th>Audio</th><th>Baris</th>";
        elseif ($page == 'imax') echo "<th>Kacamata ID</th><th>Efek</th>";
        else echo "<th>Pack</th><th>Butler</th>";
        echo "<th>Total Harga</th></tr>";

        $no = 1;
        foreach ($data as $row) {
            if ($row['jenis_studio'] == $page) {
                $obj = ($page == 'reguler') ? new TiketReguler(1, '', '', 1, $row['harga_dasar_tiket']) : 
                       (($page == 'imax') ? new TiketImax(1, '', '', 1, $row['harga_dasar_tiket']) : 
                       new TiketVelvet(1, '', '', 1, $row['harga_dasar_tiket']));
                
                echo "<tr>
                    <td>{$no}</td>
                    <td>{$row['nama_film']}</td>
                    <td>{$row['jadwal_tayang']}</td>
                    <td>".($row['tipe_audio'] ?? $row['kacamata_3d_id'] ?? $row['bantal_selimut_pack'])."</td>
                    <td>".($row['lokasi_baris'] ?? $row['efek_gerak_fitur'] ?? $row['layanan_butler'])."</td>
                    <td style='font-weight:bold; color:var(--primary)'>Rp " . number_format($obj->hitungTotalHarga(), 0, ',', '.') . "</td>
                </tr>";
                $no++;
            }
        }
        echo "</table>";
    }
    ?>
</div>
</body>
</html>
