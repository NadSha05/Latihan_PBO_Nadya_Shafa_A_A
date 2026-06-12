<?php
require_once 'Tiket.php';

class TiketImax extends Tiket {
    private $kacamata3dId;
    private $efekGerakFitur;

    public function __construct($id, $film, $jadwal, $kursi, $harga, $id3d, $efek) {
        parent::__construct($id, $film, $jadwal, $kursi, $harga);
        $this->kacamata3dId = $id3d;
        $this->efekGerakFitur = $efek;
    }

    public function hitungTotalHarga() {
        // Total Harga = (jumlah_kursi * hargaDasarTiket) + 35000
        return ($this->jumlah_kursi * $this->harga_dasar_tiket) + 35000;
    }

    public function tampilkanInfoFasilitas() {
        return "ID Kacamata: {$this->kacamata3dId}, Efek: {$this->efekGerakFitur}";
    }
}