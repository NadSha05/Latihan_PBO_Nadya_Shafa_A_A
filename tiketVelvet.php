<?php
require_once 'tiket.php';

class tiketVelvet extends tiket {
    private $bantalSelimutPack;
    private $layananButler;

    public function __construct($id, $film, $jadwal, $kursi, $harga, $pack, $butler) {
        parent::__construct($id, $film, $jadwal, $kursi, $harga);
        $this->bantalSelimutPack = $pack;
        $this->layananButler = $butler;
    }

    public function hitungTotalHarga() {
        // Total Harga = (jumlah_kursi * hargaDasarTiket) * 1.50
        return ($this->jumlah_kursi * $this->harga_dasar_tiket) * 1.50;
    }

    public function tampilkanInfoFasilitas() {
        return "Paket: " . ($this->bantalSelimutPack ? "Ya" : "Tidak") . ", Butler: " . ($this->layananButler ? "Ya" : "Tidak");
    }
}
