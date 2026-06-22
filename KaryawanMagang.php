<?php
// File: KaryawanMagang.php
require_once 'Karyawan.php';

class KaryawanMagang extends Karyawan {
    private $uangSakuBulanan;
    private $sertifikatKampusMerdeka;

    public function __construct($data) {
        parent::__construct($data);
        $this->uangSakuBulanan         = $data['uang_saku_bulanan'] ?? 0.0;
        $this->sertifikatKampusMerdeka = $data['sertifikat_kampus_merdeka'] ?? '';
    }

    // Tahap 4: Query internal untuk Karyawan Magang
    public static function ambilData($db) {
        $list = [];
        $query = "SELECT * FROM tabel_karyawan WHERE jenis_karyawan = 'Magang'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $list[] = new self($row);
        }
        return $list;
    }

    // Tahap 5: Overriding hitungGajiBersih sesuai logika bisnis Magang (potongan 20%, jadi dikali 0.80)
    public function hitungGajiBersih() {
        // Gaji Bersih = (hariKerjaMasuk * gajiDasarPerHari) * 0.80
        return ($this->hariKerjaMasuk * $this->gajiDasarPerHari) * 0.80;
    }

    public function tampilProfilKaryawan() {
        echo "<tr>";
        echo "<td>{$this->id_karyawan}</td>";
        echo "<td>{$this->nama_karyawan}</td>";
        echo "<td>{$this->departemen}</td>";
        echo "<td>{$this->jenis_karyawan}</td>";
        echo "<td>Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . "</td>";
        echo "<td>Uang Saku: Rp " . number_format($this->uangSakuBulanan, 0, ',', '.') . ", Prog: {$this->sertifikatKampusMerdeka}</td>";
        echo "</tr>";
    }
}
?>