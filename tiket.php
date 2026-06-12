<?php
// 1. Abstract Class (Penerapan Abstraksi)
abstract class tiket {
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
?>
