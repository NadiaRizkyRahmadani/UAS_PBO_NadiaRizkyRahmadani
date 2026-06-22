<?php
// File: Karyawan.php

abstract class Karyawan {
    // Properti/Atribut Terenkapsulasi (Protected)
    protected $id_karyawan;
    protected $nama_karyawan;
    protected $departemen;
    protected $hariKerjaMasuk;
    protected $gajiDasarPerHari;
    protected $jenis_karyawan;

    // Constructor untuk memetakan nilai dari kolom database ke properti objek
    public function __construct($data) {
        $this->id_karyawan      = $data['id_karyawan'] ?? null;
        $this->nama_karyawan    = $data['nama_karyawan'] ?? '';
        $this->departemen       = $data['departemen'] ?? '';
        $this->hariKerjaMasuk   = $data['hari_kerja_masuk'] ?? 0;
        $this->gajiDasarPerHari = $data['gaji_dasar_per_hari'] ?? 0.0;
        $this->jenis_karyawan   = $data['jenis_karyawan'] ?? '';
    }

    // Metode Abstrak (Wajib di-override oleh kelas anak)
    abstract public function hitungGajiBersih();
    abstract public function tampilProfilKaryawan();

    // Getter (Berguna untuk menampilkan data terenkapsulasi ke luar class)
    public function getIdKaryawan() { return $this->id_karyawan; }
    public function getNamaKaryawan() { return $this->nama_karyawan; }
    public function getDepartemen() { return $this->departemen; }
    public function getHariKerjaMasuk() { return $this->hariKerjaMasuk; }
    public function getGajiDasarPerHari() { return $this->gajiDasarPerHari; }
    public function getJenisKaryawan() { return $this->jenis_karyawan; }
}
?>