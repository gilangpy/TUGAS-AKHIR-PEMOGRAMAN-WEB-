<!-- app/views/admin/index.php -->
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold mb-1">Dashboard Admin BPBD</h2>
            <p class="text-muted mb-0">Selamat datang, <?= $data['user_nama']; ?>.</p>
        </div>
        <div>
            <a href="<?= BASE_URL; ?>/auth/logout" class="btn btn-outline-danger">Logout</a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Clickable Cards -->
    <div class="col-md-3 mb-4">
        <div class="card bg-brand text-white text-center h-100 shadow-sm border-0" style="cursor: pointer;" onclick="showDataCard('Petugas Aktif', '124 Petugas sedang berjaga di 4 Kabupaten (Bangkalan, Sampang, Pamekasan, Sumenep).')">
            <div class="card-body py-4">
                <i class="fa-solid fa-users fa-3x mb-3"></i>
                <h2 class="fw-bold">124</h2>
                <p class="mb-0">Petugas Aktif</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card bg-warning text-dark text-center h-100 shadow-sm border-0" style="cursor: pointer;" onclick="document.getElementById('tabel-laporan').scrollIntoView({behavior: 'smooth'})">
            <div class="card-body py-4">
                <i class="fa-solid fa-file-invoice fa-3x mb-3"></i>
                <h2 class="fw-bold" id="count-menunggu"><?= $data['count_menunggu'] ?? 0; ?></h2>
                <p class="mb-0">Laporan Menunggu</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card bg-danger text-white text-center h-100 shadow-sm border-0" style="cursor: pointer;" onclick="showDataCard('Peringatan Aktif', '2 Peringatan Aktif: Banjir di Bangkalan & Gelombang Tinggi di Sumenep.')">
            <div class="card-body py-4">
                <i class="fa-solid fa-triangle-exclamation fa-3x mb-3"></i>
                <h2 class="fw-bold">2</h2>
                <p class="mb-0">Peringatan Aktif</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card bg-success text-white text-center h-100 shadow-sm border-0" style="cursor: pointer;" onclick="showDataCard('Laporan Selesai', '<?= $data['count_selesai'] ?? 0; ?> Laporan telah berhasil ditangani.')">
            <div class="card-body py-4">
                <i class="fa-solid fa-check-double fa-3x mb-3"></i>
                <h2 class="fw-bold" id="count-selesai"><?= $data['count_selesai'] ?? 0; ?></h2>
                <p class="mb-0">Laporan Selesai</p>
            </div>
        </div>
    </div>
</div>

<div class="row" id="tabel-laporan">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <span class="fw-bold"><i class="fa-solid fa-clipboard-list me-2 text-brand"></i>Daftar Laporan Masyarakat</span>
                <button class="btn btn-sm btn-outline-brand"><i class="fa-solid fa-filter me-1"></i>Filter</button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Tanggal</th>
                                <th>Pelapor</th>
                                <th>Jenis Bencana</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="laporan-body">
                            <?php if (empty($data['laporan'])): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">Tidak ada laporan yang menunggu verifikasi saat ini.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($data['laporan'] as $row): ?>
                                    <tr id="row-<?= $row['id'] ?>">
                                        <td class="ps-4"><?= date('d M Y H:i', strtotime($row['created_at'])) ?></td>
                                        <td><?= htmlspecialchars($row['pelapor'] ?? 'Anonim') ?></td>
                                        <td><span class="badge bg-primary-subtle text-primary border border-primary-subtle"><i class="fa-solid <?= $row['icon'] ?> me-1"></i><?= $row['jenis_bencana'] ?></span></td>
                                        <td><?= htmlspecialchars(explode(']', explode('[', $row['deskripsi'])[2] ?? '')[0] ?? '') ?></td>
                                        <td id="status-<?= $row['id'] ?>"><span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Menunggu</span></td>
                                        <td class="text-end pe-4">
                                            <button class="btn btn-sm btn-info text-white" onclick="lihatDetail(<?= $row['id'] ?>, '<?= addslashes($row['pelapor'] ?? 'Anonim') ?>', '<?= addslashes($row['jenis_bencana']) ?>', 'Lokasi', '<?= addslashes(str_replace("\n", ' ', $row['deskripsi'])) ?>')"><i class="fa-solid fa-eye"></i> Detail</button>
                                            <button class="btn btn-sm btn-success btn-verif" id="btn-verif-<?= $row['id'] ?>" onclick="bukaVerifikasi(<?= $row['id'] ?>, '<?= addslashes($row['jenis_bencana']) ?>')"><i class="fa-solid fa-check"></i> Verifikasi</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Informasi Card -->
<div class="modal fade" id="infoCardModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 shadow">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold" id="infoCardTitle">Informasi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body py-4">
        <p class="mb-0 fs-5 text-muted" id="infoCardDesc"></p>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Detail Laporan -->
<div class="modal fade" id="detailModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 shadow">
      <div class="modal-header bg-light border-0 rounded-top-4">
        <h5 class="modal-title fw-bold"><i class="fa-solid fa-file-lines me-2 text-brand"></i>Detail Laporan Pengaduan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <div class="row mb-3">
            <div class="col-md-4 text-muted fw-semibold">Nama Pelapor</div>
            <div class="col-md-8 fw-bold" id="det-pelapor"></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 text-muted fw-semibold">Jenis Bencana</div>
            <div class="col-md-8" id="det-bencana"></div>
        </div>
        <div class="row mb-3" style="display:none;">
            <div class="col-md-4 text-muted fw-semibold">Lokasi Kejadian</div>
            <div class="col-md-8"><i class="fa-solid fa-location-dot text-danger me-1"></i> <span id="det-lokasi"></span></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4 text-muted fw-semibold">Deskripsi Laporan</div>
            <div class="col-md-8">
                <div class="p-3 bg-light rounded-3 border" id="det-desc"></div>
            </div>
        </div>
        <div class="row mb-3" id="det-solusi-container" style="display: none;">
            <div class="col-md-4 text-success fw-semibold">Penanganan / Solusi</div>
            <div class="col-md-8">
                <div class="p-3 bg-success-subtle text-success-emphasis rounded-3 border border-success-subtle fw-medium" id="det-solusi"></div>
            </div>
        </div>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Verifikasi & Penanganan -->
<div class="modal fade" id="verifModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 shadow">
      <div class="modal-header bg-success text-white border-0 rounded-top-4">
        <h5 class="modal-title fw-bold"><i class="fa-solid fa-check-double me-2"></i>Verifikasi Laporan</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <p class="mb-3">Tindak lanjuti laporan: <strong id="verif-title"></strong></p>
        <input type="hidden" id="verif-id">
        <div class="mb-3">
            <label class="form-label fw-bold">Penanganan / Solusi yang diberikan:</label>
            <textarea class="form-control rounded-3" id="verif-solusi" rows="4" placeholder="Contoh: Tim evakuasi dengan 2 perahu karet telah diterjunkan ke lokasi..."></textarea>
        </div>
      </div>
      <div class="modal-footer border-0 bg-light rounded-bottom-4">
        <button type="button" class="btn btn-secondary rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-success rounded-pill px-4 fw-bold" onclick="simpanVerifikasi()">Terima & Tindak Lanjuti</button>
      </div>
    </div>
  </div>
</div>

<script>
    const dataLaporan = {};

    function showDataCard(title, desc) {
        document.getElementById('infoCardTitle').innerText = title;
        document.getElementById('infoCardDesc').innerText = desc;
        new bootstrap.Modal(document.getElementById('infoCardModal')).show();
    }

    function lihatDetail(id, pelapor, bencana, lokasi, desc) {
        document.getElementById('det-pelapor').innerText = pelapor;
        document.getElementById('det-bencana').innerText = bencana;
        document.getElementById('det-lokasi').innerText = lokasi;
        document.getElementById('det-desc').innerText = desc;

        const solusiContainer = document.getElementById('det-solusi-container');
        if (dataLaporan[id] && dataLaporan[id].solusi) {
            document.getElementById('det-solusi').innerText = dataLaporan[id].solusi;
            solusiContainer.style.display = 'flex';
        } else {
            solusiContainer.style.display = 'none';
        }

        new bootstrap.Modal(document.getElementById('detailModal')).show();
    }

    function bukaVerifikasi(id, title) {
        document.getElementById('verif-id').value = id;
        document.getElementById('verif-title').innerText = title;
        document.getElementById('verif-solusi').value = '';
        new bootstrap.Modal(document.getElementById('verifModal')).show();
    }

    function simpanVerifikasi() {
        const id = document.getElementById('verif-id').value;
        const solusi = document.getElementById('verif-solusi').value;

        if (solusi.trim() === '') {
            alert("Harap isi penanganan atau solusi!");
            return;
        }

        const formData = new FormData();
        formData.append('id', id);
        formData.append('solusi', solusi);

        fetch('<?= BASE_URL ?>/admin/verifikasi', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // Remove row from table completely
                const row = document.getElementById('row-' + id);
                if (row) {
                    row.style.transition = 'all 0.5s';
                    row.style.opacity = '0';
                    setTimeout(() => {
                        row.remove();
                        const tbody = document.getElementById('laporan-body');
                        if (tbody && tbody.children.length === 0) {
                            tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-muted">Tidak ada laporan yang menunggu verifikasi saat ini.</td></tr>';
                        }
                    }, 500);
                }

                // Update counts
                let countMenunggu = parseInt(document.getElementById('count-menunggu').innerText);
                if (countMenunggu > 0) document.getElementById('count-menunggu').innerText = countMenunggu - 1;

                let countSelesai = parseInt(document.getElementById('count-selesai').innerText);
                document.getElementById('count-selesai').innerText = countSelesai + 1;

                bootstrap.Modal.getInstance(document.getElementById('verifModal')).hide();
            } else {
                alert('Gagal memverifikasi: ' + data.error);
            }
        })
        .catch(err => alert('Terjadi kesalahan jaringan'));
    }
</script>
