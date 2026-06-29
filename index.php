<!-- app/views/evakuasi/index.php -->

<!-- Page Header -->
<div class="evak-hero mb-4">
  <div class="evak-hero-inner">
    <div class="row align-items-center">
      <div class="col-md-7">
        <span class="badge bg-awas mb-2 px-3 py-2 fs-sm">
          <i class="fa-solid fa-shield-halved me-1"></i>SISTEM EVAKUASI TERINTEGRASI
        </span>
        <h1 class="evak-hero-title">Peta Zona Evakuasi Madura</h1>
        <p class="evak-hero-sub">Peta zona keamanan dan titik evakuasi 4 kabupaten Pulau Madura berdasarkan status bencana aktif saat ini.</p>
      </div>
      <div class="col-md-5">
        <!-- Legend -->
        <div class="evak-legend">
          <div class="evak-legend-title"><i class="fa-solid fa-circle-info me-2"></i>Keterangan Zona</div>
          <div class="legend-item"><span class="legend-dot" style="background:#205A28"></span><div><strong>Sangat Aman</strong><small>Tidak ada potensi bencana, dapat dijadikan titik pengungsian</small></div></div>
          <div class="legend-item"><span class="legend-dot" style="background:#57A85C"></span><div><strong>Aman</strong><small>Potensi bencana rendah, waspada berkala</small></div></div>
          <div class="legend-item"><span class="legend-dot" style="background:#EF6C00"></span><div><strong>Bahaya</strong><small>Bencana sedang berlangsung, persiapan evakuasi</small></div></div>
          <div class="legend-item"><span class="legend-dot" style="background:#C62828"></span><div><strong>Sangat Bahaya</strong><small>Bencana parah/aktif, segera evakuasi</small></div></div>
          <hr class="my-2">
          <div class="legend-item"><span class="legend-dot legend-shelter"></span><div><strong>Titik Evakuasi</strong><small>Shelter / titik kumpul resmi</small></div></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Filter Kabupaten -->
<div class="filter-bar mb-4">
  <div class="d-flex flex-wrap gap-2 align-items-center">
    <span class="fw-semibold text-muted me-2"><i class="fa-solid fa-filter me-1"></i>Filter:</span>
    <button class="btn-filter active" data-filter="all" onclick="filterKabupaten('all', this)">Semua Kabupaten</button>
    <button class="btn-filter" data-filter="bangkalan" onclick="filterKabupaten('bangkalan', this)">
      <span class="status-dot dot-orange"></span>Bangkalan
    </button>
    <button class="btn-filter" data-filter="sampang" onclick="filterKabupaten('sampang', this)">
      <span class="status-dot dot-green"></span>Sampang
    </button>
    <button class="btn-filter" data-filter="pamekasan" onclick="filterKabupaten('pamekasan', this)">
      <span class="status-dot dot-orange"></span>Pamekasan
    </button>
    <button class="btn-filter" data-filter="sumenep" onclick="filterKabupaten('sumenep', this)">
      <span class="status-dot dot-red"></span>Sumenep
    </button>
  </div>
</div>

<div class="row g-4">

  <!-- MAP Column -->
  <div class="col-lg-8">
    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
      <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <span class="fw-bold"><i class="fa-solid fa-map me-2 text-brand"></i>Peta Zona Evakuasi Interaktif</span>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-outline-secondary" onclick="map.setView([-7.09, 113.35], 10)">
            <i class="fa-solid fa-arrows-to-dot me-1"></i>Reset View
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <div id="mapEvakuasi"></div>
      </div>
    </div>
  </div>

  <!-- SIDEBAR Column -->
  <div class="col-lg-4">

    <!-- Status Summary per Kabupaten -->
    <div class="card shadow-sm border-0 rounded-4 mb-4">
      <div class="card-header bg-white py-3">
        <span class="fw-bold"><i class="fa-solid fa-chart-bar me-2 text-brand"></i>Status Kabupaten</span>
      </div>
      <div class="card-body p-0">
        <div class="kabupaten-status-list">

          <!-- Bangkalan -->
          <div class="kabupaten-item" data-kab="bangkalan">
            <div class="kab-top">
              <div class="kab-name">
                <div class="kab-dot bg-siaga"></div>
                <div>
                  <strong>Bangkalan</strong>
                  <div class="text-muted small">2 zona aktif</div>
                </div>
              </div>
              <span class="status-badge badge-siaga-soft">Siaga</span>
            </div>
            <div class="kab-zones">
              <div class="zone-mini" style="background:#C62828; width:15%" title="Sangat Bahaya"></div>
              <div class="zone-mini" style="background:#EF6C00; width:35%" title="Bahaya"></div>
              <div class="zone-mini" style="background:#57A85C; width:25%" title="Aman"></div>
              <div class="zone-mini" style="background:#205A28; width:25%" title="Sangat Aman"></div>
            </div>
            <div class="kab-zones-label">
              <span>15% Sangat Bahaya</span><span>35% Bahaya</span>
            </div>
            <div class="kab-bencana"><i class="fa-solid fa-water me-1 text-brand"></i>Banjir aktif: Kec. Blega, Kec. Modung</div>
          </div>

          <div class="kab-divider"></div>

          <!-- Sampang -->
          <div class="kabupaten-item" data-kab="sampang">
            <div class="kab-top">
              <div class="kab-name">
                <div class="kab-dot bg-aman"></div>
                <div>
                  <strong>Sampang</strong>
                  <div class="text-muted small">1 zona waspada</div>
                </div>
              </div>
              <span class="status-badge badge-aman-soft">Waspada</span>
            </div>
            <div class="kab-zones">
              <div class="zone-mini" style="background:#EF6C00; width:10%" title="Bahaya"></div>
              <div class="zone-mini" style="background:#57A85C; width:30%" title="Aman"></div>
              <div class="zone-mini" style="background:#205A28; width:60%" title="Sangat Aman"></div>
            </div>
            <div class="kab-zones-label">
              <span>10% Bahaya</span><span>90% Aman-Sangat Aman</span>
            </div>
            <div class="kab-bencana"><i class="fa-solid fa-wind me-1 text-brand"></i>Angin kencang: Kec. Omben</div>
          </div>

          <div class="kab-divider"></div>

          <!-- Pamekasan -->
          <div class="kabupaten-item" data-kab="pamekasan">
            <div class="kab-top">
              <div class="kab-name">
                <div class="kab-dot bg-siaga"></div>
                <div>
                  <strong>Pamekasan</strong>
                  <div class="text-muted small">2 zona aktif</div>
                </div>
              </div>
              <span class="status-badge badge-siaga-soft">Siaga</span>
            </div>
            <div class="kab-zones">
              <div class="zone-mini" style="background:#EF6C00; width:40%" title="Bahaya"></div>
              <div class="zone-mini" style="background:#57A85C; width:35%" title="Aman"></div>
              <div class="zone-mini" style="background:#205A28; width:25%" title="Sangat Aman"></div>
            </div>
            <div class="kab-zones-label">
              <span>40% Bahaya</span><span>60% Aman-Sangat Aman</span>
            </div>
            <div class="kab-bencana"><i class="fa-solid fa-sun me-1 text-brand"></i>Kekeringan: Kec. Batumarmar, Kec. Pasean</div>
          </div>

          <div class="kab-divider"></div>

          <!-- Sumenep -->
          <div class="kabupaten-item" data-kab="sumenep">
            <div class="kab-top">
              <div class="kab-name">
                <div class="kab-dot bg-awas"></div>
                <div>
                  <strong>Sumenep</strong>
                  <div class="text-muted small">3 zona aktif</div>
                </div>
              </div>
              <span class="status-badge badge-awas-soft">Awas</span>
            </div>
            <div class="kab-zones">
              <div class="zone-mini" style="background:#C62828; width:30%" title="Sangat Bahaya"></div>
              <div class="zone-mini" style="background:#EF6C00; width:30%" title="Bahaya"></div>
              <div class="zone-mini" style="background:#57A85C; width:20%" title="Aman"></div>
              <div class="zone-mini" style="background:#205A28; width:20%" title="Sangat Aman"></div>
            </div>
            <div class="kab-zones-label">
              <span>30% Sangat Bahaya</span><span>30% Bahaya</span>
            </div>
            <div class="kab-bencana"><i class="fa-solid fa-water me-1 text-brand"></i>Gelombang tinggi & abrasi pesisir utara-timur</div>
          </div>

        </div>
      </div>
    </div>

    <!-- Shelter Terdekat -->
    <div class="card shadow-sm border-0 rounded-4">
      <div class="card-header bg-white py-3">
        <span class="fw-bold"><i class="fa-solid fa-house-chimney-medical me-2 text-brand"></i>Titik Evakuasi / Shelter</span>
      </div>
      <div class="shelter-list">
        <div class="shelter-item" onclick="flyToShelter(-7.0021, 112.7313, 'GOR Bangkalan')">
          <div class="shelter-icon bg-brand"><i class="fa-solid fa-hospital"></i></div>
          <div class="shelter-info">
            <strong>GOR Bangkalan</strong>
            <div class="text-muted small">Bangkalan &bull; Kap. 500 orang</div>
          </div>
          <span class="badge bg-aman-custom">Sangat Aman</span>
        </div>
        <div class="shelter-item" onclick="flyToShelter(-7.0350, 112.7800, 'SMPN 1 Bangkalan')">
          <div class="shelter-icon bg-brand"><i class="fa-solid fa-school"></i></div>
          <div class="shelter-info">
            <strong>SMPN 1 Bangkalan</strong>
            <div class="text-muted small">Bangkalan &bull; Kap. 300 orang</div>
          </div>
          <span class="badge bg-aman-custom">Sangat Aman</span>
        </div>
        <div class="shelter-item" onclick="flyToShelter(-7.1895, 113.2435, 'Masjid Agung Sampang')">
          <div class="shelter-icon bg-brand"><i class="fa-solid fa-mosque"></i></div>
          <div class="shelter-info">
            <strong>Masjid Agung Sampang</strong>
            <div class="text-muted small">Sampang &bull; Kap. 400 orang</div>
          </div>
          <span class="badge bg-aman-custom">Aman</span>
        </div>
        <div class="shelter-item" onclick="flyToShelter(-7.1611, 113.4700, 'GOR Pamekasan')">
          <div class="shelter-icon bg-brand"><i class="fa-solid fa-hospital"></i></div>
          <div class="shelter-info">
            <strong>GOR Pamekasan</strong>
            <div class="text-muted small">Pamekasan &bull; Kap. 600 orang</div>
          </div>
          <span class="badge bg-aman-custom">Sangat Aman</span>
        </div>
        <div class="shelter-item" onclick="flyToShelter(-7.0163, 113.8500, 'Kantor BPBD Sumenep')">
          <div class="shelter-icon bg-brand"><i class="fa-solid fa-building-shield"></i></div>
          <div class="shelter-info">
            <strong>Kantor BPBD Sumenep</strong>
            <div class="text-muted small">Sumenep &bull; Kap. 200 orang</div>
          </div>
          <span class="badge bg-aman-custom">Aman</span>
        </div>
        <div class="shelter-item" onclick="flyToShelter(-7.0500, 113.9000, 'Balai Desa Batang-Batang')">
          <div class="shelter-icon bg-brand"><i class="fa-solid fa-landmark"></i></div>
          <div class="shelter-info">
            <strong>Balai Desa Batang-Batang</strong>
            <div class="text-muted small">Sumenep &bull; Kap. 150 orang</div>
          </div>
          <span class="badge bg-aman-custom">Sangat Aman</span>
        </div>
      </div>
    </div>

  </div><!-- end sidebar -->
</div>

<!-- Page Styles -->
<style>
  :root {
    --c-sangat-aman: #205A28;
    --c-aman:        #57A85C;
    --c-bahaya:      #EF6C00;
    --c-sangat-bhy:  #C62828;
    --c-brand:       #106EBE;
  }

  .evak-hero {
    background: linear-gradient(135deg, #0d3b6e 0%, #205A28 100%);
    border-radius: 20px; overflow: hidden; padding: 36px;
    position: relative;
  }
  .evak-hero::after {
    content: '';
    position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='white' fill-opacity='0.03'%3E%3Ccircle cx='40' cy='40' r='30'/%3E%3C/g%3E%3C/svg%3E");
  }
  .evak-hero-inner { position: relative; z-index: 1; }
  .evak-hero-title { font-size: 1.8rem; font-weight: 800; color: white; margin-bottom: 8px; }
  .evak-hero-sub { color: rgba(255,255,255,0.85); font-size: 0.9rem; margin: 0; }

  .evak-legend {
    background: rgba(255,255,255,0.12);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 14px; padding: 16px;
  }
  .evak-legend-title { color: white; font-weight: 700; font-size: 0.85rem; margin-bottom: 10px; }
  .legend-item { display: flex; align-items: flex-start; gap: 10px; margin-bottom: 8px; }
  .legend-dot {
    width: 16px; height: 16px; border-radius: 50%;
    flex-shrink: 0; margin-top: 3px;
    box-shadow: 0 0 0 2px rgba(255,255,255,0.3);
  }
  .legend-shelter { background: var(--c-brand); border: 2px solid white; }
  .legend-item strong { color: white; font-size: 0.8rem; display: block; }
  .legend-item small { color: rgba(255,255,255,0.7); font-size: 0.72rem; line-height: 1.3; }

  /* Filter Bar */
  .filter-bar { padding: 12px 16px; background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
  .btn-filter {
    background: #f4f4f4; border: none; border-radius: 20px;
    padding: 6px 16px; font-size: 0.83rem; font-weight: 500;
    cursor: pointer; display: flex; align-items: center; gap: 6px;
    font-family: 'Poppins', sans-serif; transition: all 0.2s;
  }
  .btn-filter:hover { background: #e0eaff; color: var(--c-brand); }
  .btn-filter.active { background: var(--c-brand); color: white; }
  .status-dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; }
  .dot-red    { background: var(--c-sangat-bhy); }
  .dot-orange { background: var(--c-bahaya); }
  .dot-green  { background: var(--c-aman); }

  /* Map */
  #mapEvakuasi { height: 520px; width: 100%; }

  /* Kabupaten Status List */
  .kabupaten-status-list { padding: 0; }
  .kabupaten-item { padding: 16px; }
  .kab-divider { height: 1px; background: #f0f0f0; }
  .kab-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; }
  .kab-name { display: flex; align-items: center; gap: 10px; }
  .kab-dot { width: 12px; height: 12px; border-radius: 50%; flex-shrink: 0; }
  .bg-aman  { background: var(--c-aman); }
  .bg-siaga { background: var(--c-bahaya); }
  .bg-awas  { background: var(--c-sangat-bhy); }
  .bg-aman-custom { background: var(--c-sangat-aman) !important; font-size: 0.7rem; }
  .bg-brand { background: var(--c-brand) !important; }

  .kab-zones { display: flex; height: 10px; border-radius: 8px; overflow: hidden; gap: 2px; margin-bottom: 4px; }
  .zone-mini { height: 100%; border-radius: 4px; transition: all 0.3s; }
  .kab-zones-label { display: flex; justify-content: space-between; font-size: 0.7rem; color: #888; margin-bottom: 6px; }
  .kab-bencana { font-size: 0.8rem; color: #555; }

  .status-badge { padding: 4px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 700; }
  .badge-aman-soft  { background: #e8f5e9; color: #205A28; }
  .badge-siaga-soft { background: #fff3e0; color: #EF6C00; }
  .badge-awas-soft  { background: #ffebee; color: #C62828; }

  /* Shelter List */
  .shelter-list { padding: 8px 0; }
  .shelter-item {
    display: flex; align-items: center; gap: 12px;
    padding: 12px 16px; cursor: pointer;
    transition: background 0.15s;
    border-bottom: 1px solid #f5f5f5;
  }
  .shelter-item:last-child { border-bottom: none; }
  .shelter-item:hover { background: #f0f7ff; }
  .shelter-icon {
    width: 36px; height: 36px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: 0.9rem; flex-shrink: 0;
  }
  .shelter-info { flex-grow: 1; }
  .shelter-info strong { font-size: 0.85rem; display: block; }

  /* Leaflet Popup Custom */
  .popup-zona { font-family: 'Poppins', sans-serif; min-width: 200px; }
  .popup-zona .pz-header { font-weight: 700; font-size: 1rem; margin-bottom: 6px; }
  .popup-zona .pz-badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; margin-bottom: 8px; color: white; }
  .popup-zona .pz-row { font-size: 0.82rem; color: #444; margin-bottom: 3px; }
  .popup-zona .pz-btn { display: block; margin-top: 10px; padding: 7px 14px; background: #106EBE; color: white; border-radius: 8px; text-align: center; text-decoration: none; font-size: 0.8rem; font-weight: 600; }

  .bg-awas { background: var(--c-sangat-bhy); }
</style>

<script>
// =====================================================
//  DATA ZONA EVAKUASI PER KABUPATEN
//  Setiap kabupaten punya 4 zona dengan radius berbeda
// =====================================================

// Variabel global agar bisa diakses dari onclick di HTML
var map, layerGroups = {}, allLayers = [];

var zonaData = {
  bangkalan: {
    center: [-7.0263, 112.7441],
    nama: 'Kabupaten Bangkalan',
    bencana: 'Banjir (Kec. Blega & Kec. Modung)',
    status: 'Siaga',
    statusColor: '#EF6C00',
    zones: [
      {
        label: 'Sangat Bahaya',
        color: '#C62828',
        opacity: 0.55,
        radius: 4500,
        lat: -7.0550, lng: 112.7600,
        kecamatan: 'Kec. Blega',
        catatan: 'Banjir aktif, ketinggian air 80–120 cm. Segera evakuasi!',
        evakuasi: 'GOR Bangkalan (12 km ke barat)'
      },
      {
        label: 'Bahaya',
        color: '#EF6C00',
        opacity: 0.45,
        radius: 5500,
        lat: -7.0700, lng: 112.7900,
        kecamatan: 'Kec. Modung',
        catatan: 'Potensi banjir tinggi dalam 6 jam ke depan.',
        evakuasi: 'SMPN 1 Bangkalan (8 km ke barat)'
      },
      {
        label: 'Aman',
        color: '#57A85C',
        opacity: 0.35,
        radius: 6000,
        lat: -7.0100, lng: 112.7200,
        kecamatan: 'Kec. Bangkalan (Kota)',
        catatan: 'Situasi terpantau aman. Tetap waspada.',
        evakuasi: '-'
      },
      {
        label: 'Sangat Aman',
        color: '#205A28',
        opacity: 0.30,
        radius: 7000,
        lat: -6.9800, lng: 112.6900,
        kecamatan: 'Kec. Socah',
        catatan: 'Tidak ada potensi bencana. Dapat digunakan sebagai area pengungsian.',
        evakuasi: 'GOR Bangkalan (lokasi ini)'
      }
    ],
    shelters: [
      { lat: -7.0021, lng: 112.7313, nama: 'GOR Bangkalan', kap: 500 },
      { lat: -7.0350, lng: 112.7800, nama: 'SMPN 1 Bangkalan', kap: 300 }
    ]
  },

  sampang: {
    center: [-7.1895, 113.2435],
    nama: 'Kabupaten Sampang',
    bencana: 'Angin Kencang (Kec. Omben)',
    status: 'Waspada',
    statusColor: '#F9A825',
    zones: [
      {
        label: 'Bahaya',
        color: '#EF6C00',
        opacity: 0.45,
        radius: 3500,
        lat: -7.2100, lng: 113.2800,
        kecamatan: 'Kec. Omben',
        catatan: 'Angin kencang >60 km/jam. Hindari area terbuka dan pohon besar.',
        evakuasi: 'Masjid Agung Sampang (7 km ke barat)'
      },
      {
        label: 'Aman',
        color: '#57A85C',
        opacity: 0.35,
        radius: 5000,
        lat: -7.1800, lng: 113.2200,
        kecamatan: 'Kec. Sampang (Kota)',
        catatan: 'Situasi terpantau aman. Potensi hujan deras.',
        evakuasi: '-'
      },
      {
        label: 'Sangat Aman',
        color: '#205A28',
        opacity: 0.30,
        radius: 7500,
        lat: -7.1500, lng: 113.1800,
        kecamatan: 'Kec. Kedungdung',
        catatan: 'Tidak ada potensi bencana aktif.',
        evakuasi: '-'
      },
      {
        label: 'Sangat Aman',
        color: '#205A28',
        opacity: 0.25,
        radius: 8000,
        lat: -7.2300, lng: 113.1500,
        kecamatan: 'Kec. Robatal',
        catatan: 'Wilayah dataran tinggi, sangat aman dari banjir.',
        evakuasi: 'Dapat dijadikan titik pengungsian darurat'
      }
    ],
    shelters: [
      { lat: -7.1895, lng: 113.2435, nama: 'Masjid Agung Sampang', kap: 400 }
    ]
  },

  pamekasan: {
    center: [-7.1611, 113.4819],
    nama: 'Kabupaten Pamekasan',
    bencana: 'Kekeringan (Kec. Batumarmar & Kec. Pasean)',
    status: 'Siaga',
    statusColor: '#EF6C00',
    zones: [
      {
        label: 'Sangat Bahaya',
        color: '#C62828',
        opacity: 0.50,
        radius: 4000,
        lat: -7.0800, lng: 113.5100,
        kecamatan: 'Kec. Batumarmar',
        catatan: 'Kekeringan parah. Sumber air tanah habis. Distribusi air bersih darurat diperlukan.',
        evakuasi: 'GOR Pamekasan (18 km ke selatan)'
      },
      {
        label: 'Bahaya',
        color: '#EF6C00',
        opacity: 0.40,
        radius: 5000,
        lat: -7.0500, lng: 113.4900,
        kecamatan: 'Kec. Pasean',
        catatan: 'Kekeringan sedang. Sumur warga mulai kering.',
        evakuasi: 'GOR Pamekasan (15 km ke selatan)'
      },
      {
        label: 'Aman',
        color: '#57A85C',
        opacity: 0.35,
        radius: 5500,
        lat: -7.1700, lng: 113.4700,
        kecamatan: 'Kec. Pamekasan (Kota)',
        catatan: 'Pasokan air PDAM masih normal.',
        evakuasi: '-'
      },
      {
        label: 'Sangat Aman',
        color: '#205A28',
        opacity: 0.28,
        radius: 6500,
        lat: -7.2200, lng: 113.4600,
        kecamatan: 'Kec. Galis',
        catatan: 'Tidak ada potensi bencana. Dapat menampung pengungsi.',
        evakuasi: 'GOR Pamekasan (lokasi sekitar)'
      }
    ],
    shelters: [
      { lat: -7.1611, lng: 113.4700, nama: 'GOR Pamekasan', kap: 600 }
    ]
  },

  sumenep: {
    center: [-7.0163, 113.8660],
    nama: 'Kabupaten Sumenep',
    bencana: 'Gelombang Tinggi & Abrasi Pantai Utara-Timur',
    status: 'Awas',
    statusColor: '#C62828',
    zones: [
      {
        label: 'Sangat Bahaya',
        color: '#C62828',
        opacity: 0.60,
        radius: 5000,
        lat: -6.9500, lng: 113.9500,
        kecamatan: 'Kec. Ambunten (Pesisir Utara)',
        catatan: 'Gelombang tinggi 3–5 meter. Abrasi aktif. SEGERA TINGGALKAN AREA PESISIR.',
        evakuasi: 'Kantor BPBD Sumenep (20 km ke selatan)'
      },
      {
        label: 'Sangat Bahaya',
        color: '#C62828',
        opacity: 0.55,
        radius: 4500,
        lat: -7.0000, lng: 114.0500,
        kecamatan: 'Kec. Batang-Batang (Pesisir Timur)',
        catatan: 'Gelombang tinggi aktif. Nelayan dilarang melaut.',
        evakuasi: 'Balai Desa Batang-Batang (daratan)'
      },
      {
        label: 'Bahaya',
        color: '#EF6C00',
        opacity: 0.40,
        radius: 6000,
        lat: -6.9800, lng: 113.8800,
        kecamatan: 'Kec. Dungkek',
        catatan: 'Potensi gelombang tinggi dalam 12 jam ke depan.',
        evakuasi: 'Kantor BPBD Sumenep'
      },
      {
        label: 'Aman',
        color: '#57A85C',
        opacity: 0.30,
        radius: 5500,
        lat: -7.0200, lng: 113.8500,
        kecamatan: 'Kec. Sumenep (Kota)',
        catatan: 'Situasi kota aman. Jauh dari pesisir.',
        evakuasi: 'Kantor BPBD Sumenep (lokasi ini)'
      },
      {
        label: 'Sangat Aman',
        color: '#205A28',
        opacity: 0.25,
        radius: 6000,
        lat: -7.0800, lng: 113.8200,
        kecamatan: 'Kec. Lenteng',
        catatan: 'Dataran tinggi, sangat aman dari gelombang.',
        evakuasi: 'Dapat dijadikan titik pengungsian'
      }
    ],
    shelters: [
      { lat: -7.0163, lng: 113.8500, nama: 'Kantor BPBD Sumenep', kap: 200 },
      { lat: -7.0500, lng: 113.9000, nama: 'Balai Desa Batang-Batang', kap: 150 }
    ]
  }
};

// =====================================================
//  INIT MAP — wrapped in DOMContentLoaded
//  Memastikan div #mapEvakuasi sudah ada di DOM
//  dan Leaflet (L) sudah ter-load di <head>
// =====================================================
document.addEventListener('DOMContentLoaded', function () {

  map = L.map('mapEvakuasi').setView([-7.09, 113.35], 10);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  // Custom shelter icon
  var shelterIcon = L.divIcon({
    html: '<div style="background:#106EBE;width:28px;height:28px;border-radius:50%;border:3px solid white;box-shadow:0 2px 8px rgba(0,0,0,0.3);display:flex;align-items:center;justify-content:center;color:white;font-size:13px;"><i class="fa fa-house-chimney-medical"></i></div>',
    className: '',
    iconSize: [28, 28],
    iconAnchor: [14, 14],
    popupAnchor: [0, -16]
  });

  // Draw all zones and shelters
  Object.keys(zonaData).forEach(function(kab) {
    var d = zonaData[kab];
    var group = L.layerGroup();

    d.zones.forEach(function(z) {
      var circle = L.circle([z.lat, z.lng], {
        color: z.color,
        fillColor: z.color,
        fillOpacity: z.opacity,
        weight: 2,
        radius: z.radius
      });

      var badgeBg = z.color;
      circle.bindPopup(
        '<div class="popup-zona">' +
        '<div class="pz-header">' + z.kecamatan + '</div>' +
        '<span class="pz-badge" style="background:' + badgeBg + '">' + z.label + '</span>' +
        '<div class="pz-row"><b>Kabupaten:</b> ' + d.nama + '</div>' +
        '<div class="pz-row"><b>Bencana:</b> ' + d.bencana + '</div>' +
        '<div class="pz-row"><b>Kondisi:</b> ' + z.catatan + '</div>' +
        '<div class="pz-row"><b>Evakuasi ke:</b> ' + z.evakuasi + '</div>' +
        '<a href="<?= BASE_URL ?>/laporan/create" class="pz-btn"><i class="fa fa-triangle-exclamation me-1"></i>Lapor Kejadian</a>' +
        '</div>',
        { maxWidth: 260 }
      );

      group.addLayer(circle);
      allLayers.push({ layer: circle, kab: kab });
    });

    // Shelter markers
    d.shelters.forEach(function(s) {
      var marker = L.marker([s.lat, s.lng], { icon: shelterIcon });
      marker.bindPopup(
        '<div class="popup-zona">' +
        '<div class="pz-header"><i class="fa fa-house-chimney-medical" style="color:#106EBE;margin-right:6px;"></i>' + s.nama + '</div>' +
        '<div class="pz-row"><b>Kabupaten:</b> ' + d.nama + '</div>' +
        '<div class="pz-row"><b>Kapasitas:</b> ' + s.kap + ' orang</div>' +
        '<div class="pz-row"><b>Status:</b> <span style="color:#205A28;font-weight:700;">Titik Evakuasi Resmi</span></div>' +
        '</div>',
        { maxWidth: 220 }
      );
      group.addLayer(marker);
      allLayers.push({ layer: marker, kab: kab });
    });

    group.addTo(map);
    layerGroups[kab] = group;
  });

}); // END DOMContentLoaded

// =====================================================
//  FUNGSI GLOBAL — dipanggil dari onclick di HTML
// =====================================================
function filterKabupaten(target, btn) {
  document.querySelectorAll('.btn-filter').forEach(function(b) { b.classList.remove('active'); });
  btn.classList.add('active');

  Object.keys(layerGroups).forEach(function(kab) {
    if (target === 'all' || target === kab) {
      map.addLayer(layerGroups[kab]);
    } else {
      map.removeLayer(layerGroups[kab]);
    }
  });

  if (target !== 'all' && zonaData[target]) {
    map.flyTo(zonaData[target].center, 12, { duration: 1.2 });
  } else {
    map.flyTo([-7.09, 113.35], 10, { duration: 1.2 });
  }
}

function flyToShelter(lat, lng, nama) {
  map.flyTo([lat, lng], 14, { duration: 1.5 });
  setTimeout(function() {
    allLayers.forEach(function(l) {
      if (l.layer.getLatLng && Math.abs(l.layer.getLatLng().lat - lat) < 0.0001) {
        l.layer.openPopup();
      }
    });
  }, 1600);
}
</script>
