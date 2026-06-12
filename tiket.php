<?php
// 1. Abstract Class (Penerapan Abstraksi)
abstract class Tiket {
    protected $id_tiket;
    protected $nama_film;
    protected $jadwal_tayang;
    protected $jumlah_kursi;
    protected $harga_dasar_tiket;

    public function __construct($id, $film, $jadwal, $kursi, $harga) {
        $this->id_tiket = $id;
        $this->nama_film = $film;
        $this->jadwal_tayang = $jadwal;
        $this->jumlah_kursi = $kursi;
        $this->harga_dasar_tiket = $harga;
    }

    // Metode Abstrak
    abstract public function hitungTotalHarga();
    abstract public function tampilkanInfoFasilitas();
}

// 2. Kelas Turunan (Contoh untuk Velvet)
class TiketVelvet extends Tiket {
    public function hitungTotalHarga() {
        // Logika: Harga dasar + biaya layanan butler
        return ($this->harga_dasar_tiket * $this->jumlah_kursi) + 50000;
    }

    public function tampilkanInfoFasilitas() {
        echo "Fasilitas: bantal, selimut, dan layanan butler eksklusif.";
    }
}
?>