<?php
// File: KaryawanKontrak.php
require_once 'Karyawan.php';

class KaryawanKontrak extends Karyawan {
    private $durasiKontrakBulan;
    private $agensiPenyalur;

    public function __construct($data) {
        parent::__construct($data);
        $this->durasiKontrakBulan = $data['durasi_kontrak_bulan'] ?? 0;
        $this->agensiPenyalur     = $data['agensi_penyalur'] ?? '';
    }

    // Fokus Utama: Query SELECT * FROM dengan kondisi WHERE Kontrak
    public static function ambilData($db) {
        $list = [];
        $query = "SELECT * FROM tabel_karyawan WHERE jenis_karyawan = 'Kontrak'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $list[] = new self($row);
        }
        return $list;
    }

    // Method abstract disiapkan dulu, hitungannya menyusul di Tahap 5
    public function hitungGajiBersih() {
        return 0; 
    }

    public function tampilProfilKaryawan() {
        echo "<tr>";
        echo "<td>{$this->id_karyawan}</td>";
        echo "<td>{$this->nama_karyawan}</td>";
        echo "<td>{$this->departemen}</td>";
        echo "<td>{$this->jenis_karyawan}</td>";
        echo "<td>Durasi: {$this->durasiKontrakBulan} Bulan, Agensi: {$this->agensiPenyalur}</td>";
        echo "</tr>";
    }
}
?>