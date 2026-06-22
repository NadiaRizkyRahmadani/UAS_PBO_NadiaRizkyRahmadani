<?php
// File: index.php
require_once 'koneksi.php';
require_once 'KaryawanKontrak.php';
require_once 'KaryawanTetap.php';
require_once 'KaryawanMagang.php';

// Inisialisasi koneksi database
$database = new Koneksi();
$db = $database->getConnection();

// Mengambil data secara terkelompok sesuai objek masing-masing kelas
$dataKontrak = KaryawanKontrak::ambilData($db);
$dataTetap   = KaryawanTetap::ambilData($db);
$dataMagang  = KaryawanMagang::ambilData($db);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Slip Gaji Karyawan - TI 1C</title>
    <style>
        /* Desain Antarmuka Modern, Clean & Responsive */
        :root {
            --primary-color: #4a6fa5;
            --tetap-color: #1e88e5;
            --kontrak-color: #fb8c00;
            --magang-color: #43a047;
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #334155;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-color);
            margin: 0;
            padding: 30px 20px;
            color: var(--text-main);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        header {
            background: var(--card-bg);
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            margin-bottom: 25px;
            border-left: 5px solid var(--primary-color);
        }

        header h1 {
            margin: 0;
            color: #1e293b;
            font-size: 28px;
            font-weight: 700;
        }

        header p {
            margin: 8px 0 0 0;
            color: var(--text-muted);
            font-size: 15px;
        }

        /* Navigasi / Tab Filter */
        .tab-navigation {
            display: flex;
            gap: 12px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .tab-btn {
            padding: 12px 24px;
            border: none;
            background: var(--card-bg);
            color: var(--text-main);
            font-size: 15px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tab-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        /* Status Aktif untuk Masing-masing Tombol */
        .tab-btn[data-target="all"].active { background: #334155; color: #fff; }
        .tab-btn[data-target="tetap"].active { background: var(--tetap-color); color: #fff; }
        .tab-btn[data-target="kontrak"].active { background: var(--kontrak-color); color: #fff; }
        .tab-btn[data-target="magang"].active { background: var(--magang-color); color: #fff; }

        /* Konten Kategori (Animasi Fade-in) */
        .section-kategori {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            display: block; /* Default tampil semua, diatur oleh JS nantinya */
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .section-kategori h2 {
            margin-top: 0;
            padding-bottom: 12px;
            border-bottom: 2px solid #e2e8f0;
            font-size: 22px;
            font-weight: 600;
        }

        .kategori-tetap h2 { color: var(--tetap-color); }
        .kategori-kontrak h2 { color: var(--kontrak-color); }
        .kategori-magang h2 { color: var(--magang-color); }

        /* Wrapper Tabel agar Responsive */
        .table-responsive {
            overflow-x: auto;
            margin-top: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 14px 18px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 15px;
        }

        th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        tr:hover {
            background-color: #f8fafc;
        }

        /* Badges & Text Styling */
        .gaji-bersih {
            font-weight: 700;
            color: #0f172a;
        }

        .badge-spesifik {
            background-color: #f1f5f9;
            color: #334155;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            display: inline-block;
            font-weight: 500;
            border: 1px solid #e2e8f0;
        }

        .no-data {
            text-align: center;
            color: var(--text-muted);
            padding: 40px 20px;
            font-style: italic;
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h1>Sistem Slip Gaji Karyawan Berbasis OOP</h1>
        <p>Kelola dan tampilkan informasi penggajian berdasarkan kategori jabatan dengan mudah.</p>
    </header>

    <div class="tab-navigation">
        <button class="tab-btn active" data-target="all">📂 Semua Karyawan</button>
        <button class="tab-btn" data-target="tetap">🔵 Karyawan Tetap</button>
        <button class="tab-btn" data-target="kontrak">🟠 Karyawan Kontrak</button>
        <button class="tab-btn" data-target="magang">🟢 Karyawan Magang</button>
    </div>

    <div class="section-kategori kategori-tetap" data-category="tetap">
        <h2>Karyawan Tetap</h2>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID Karyawan</th>
                        <th>Nama Karyawan</th>
                        <th>Departemen</th>
                        <th>Hari Kerja</th>
                        <th>Gaji Dasar / Hari</th>
                        <th>Spesifikasi Jabatan</th>
                        <th>Gaji Bersih (Slip)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($dataTetap)): ?>
                        <?php foreach ($dataTetap as $karyawan): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($karyawan->getIdKaryawan()) ?></strong></td>
                                <td><?= htmlspecialchars($karyawan->getNamaKaryawan()) ?></td>
                                <td><?= htmlspecialchars($karyawan->getDepartemen()) ?></td>
                                <td><?= htmlspecialchars($karyawan->getHariKerjaMasuk()) ?> Hari</td>
                                <td>Rp <?= number_format($karyawan->getGajiDasarPerHari(), 0, ',', '.') ?></td>
                                <td><span class="badge-spesifik"><?php $karyawan->tampilProfilKaryawan(); ?></span></td>
                                <td class="gaji-bersih">Rp <?= number_format($karyawan->hitungGajiBersih(), 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="no-data">Tidak ada data Karyawan Tetap.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="section-kategori kategori-kontrak" data-category="kontrak">
        <h2>Karyawan Kontrak</h2>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID Karyawan</th>
                        <th>Nama Karyawan</th>
                        <th>Departemen</th>
                        <th>Hari Kerja</th>
                        <th>Gaji Dasar / Hari</th>
                        <th>Spesifikasi Jabatan</th>
                        <th>Gaji Bersih (Slip)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($dataKontrak)): ?>
                        <?php foreach ($dataKontrak as $karyawan): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($karyawan->getIdKaryawan()) ?></strong></td>
                                <td><?= htmlspecialchars($karyawan->getNamaKaryawan()) ?></td>
                                <td><?= htmlspecialchars($karyawan->getDepartemen()) ?></td>
                                <td><?= htmlspecialchars($karyawan->getHariKerjaMasuk()) ?> Hari</td>
                                <td>Rp <?= number_format($karyawan->getGajiDasarPerHari(), 0, ',', '.') ?></td>
                                <td><span class="badge-spesifik"><?php $karyawan->tampilProfilKaryawan(); ?></span></td>
                                <td class="gaji-bersih">Rp <?= number_format($karyawan->hitungGajiBersih(), 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="no-data">Tidak ada data Karyawan Kontrak.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="section-kategori kategori-magang" data-category="magang">
        <h2>Karyawan Magang</h2>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID Karyawan</th>
                        <th>Nama Karyawan</th>
                        <th>Departemen</th>
                        <th>Hari Kerja</th>
                        <th>Gaji Dasar / Hari</th>
                        <th>Spesifikasi Jabatan</th>
                        <th>Gaji Bersih (Slip)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($dataMagang)): ?>
                        <?php foreach ($dataMagang as $karyawan): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($karyawan->getIdKaryawan()) ?></strong></td>
                                <td><?= htmlspecialchars($karyawan->getNamaKaryawan()) ?></td>
                                <td><?= htmlspecialchars($karyawan->getDepartemen()) ?></td>
                                <td><?= htmlspecialchars($karyawan->getHariKerjaMasuk()) ?> Hari</td>
                                <td>Rp <?= number_format($karyawan->getGajiDasarPerHari(), 0, ',', '.') ?></td>
                                <td><span class="badge-spesifik"><?php $karyawan->tampilProfilKaryawan(); ?></span></td>
                                <td class="gaji-bersih">Rp <?= number_format($karyawan->hitungGajiBersih(), 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="no-data">Tidak ada data Karyawan Magang.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll('.tab-btn');
        const sections = document.querySelectorAll('.section-kategori');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                // 1. Hapus status aktif dari semua tombol
                buttons.forEach(btn => btn.classList.remove('active'));
                // 2. Set tombol yang diklik menjadi aktif
                button.classList.add('active');

                const target = button.getAttribute('data-target');

                // 3. Tampilkan/Sembunyikan tabel berdasarkan pilihan
                sections.forEach(section => {
                    if (target === 'all') {
                        section.style.display = 'block';
                    } else {
                        if (section.getAttribute('data-category') === target) {
                            section.style.display = 'block';
                        } else {
                            section.style.display = 'none';
                        }
                    }
                });
            });
        });
    });
</script>

</body>
</html>