<?php
require_once 'Tiket.php';

class TiketReguler extends Tiket {
    private $tipeAudio;
    private $lokasiBaris;

    public function __construct($id, $film, $jadwal, $kursi, $harga, $audio, $baris) {
        parent::__construct($id, $film, $jadwal, $kursi, $harga);
        $this->tipeAudio = $audio;
        $this->lokasiBaris = $baris;
    }

    public function hitungTotalHarga() {
        // Total Harga = jumlah_kursi * hargaDasarTiket
        return $this->jumlah_kursi * $this->harga_dasar_tiket;
    }

    public function tampilkanInfoFasilitas() {
        return "Audio: {$this->tipeAudio}, Baris: {$this->lokasiBaris}";
    }
}