<?php
// File: KaryawanTetap.php
require_once 'Karyawan.php';

class KaryawanTetap extends Karyawan {
    private $tunjanganKesehatan;
    private $opsiSahamId;

    public function __construct($data) {
        parent::__construct($data);
        $this->tunjanganKesehatan = $data['tunjangan_kesehatan'] ?? 0.0;
        $this->opsiSahamId        = $data['opsi_saham_id'] ?? '';
    }

    // Tahap 4: Query internal untuk Karyawan Tetap
    public static function ambilData($db) {
        $list = [];
        $query = "SELECT * FROM tabel_karyawan WHERE jenis_karyawan = 'Tetap'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $list[] = new self($row);
        }
        return $list;
    }

    // Tahap 5: Overriding hitungGajiBersih sesuai logika bisnis Tetap
    public function hitungGajiBersih() {
        // Gaji Bersih = (hariKerjaMasuk * gajiDasarPerHari) + tunjanganKesehatan
        return ($this->hariKerjaMasuk * $this->gajiDasarPerHari) + $this->tunjanganKesehatan;
    }

    public function tampilProfilKaryawan() {
        echo "<tr>";
        echo "<td>{$this->id_karyawan}</td>";
        echo "<td>{$this->nama_karyawan}</td>";
        echo "<td>{$this->departemen}</td>";
        echo "<td>{$this->jenis_karyawan}</td>";
        echo "<td>Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . "</td>";
        echo "<td>Tunjangan: Rp " . number_format($this->tunjanganKesehatan, 0, ',', '.') . ", Saham ID: {$this->opsiSahamId}</td>";
        echo "</tr>";
    }
}
?>