<div>
    <main>
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Home</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Jumlah Penerima -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Jumlah Penerima</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ \App\Models\Penerima::count() }}</h6>
                                            <span class="text-muted small pt-2 ps-1">Total Data</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Jumlah Kendaraan -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">Jumlah Kendaraan</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-truck"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ \App\Models\Kendaraan::count() }}</h6>
                                            <span class="text-muted small pt-2 ps-1">Total Data</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Jumlah Skor -->
                        <div class="col-xxl-4 col-xl-12">
                            <div class="card info-card customers-card">
                                <div class="card-body">
                                    <h5 class="card-title">Data Skor Tersimpan</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-clipboard-data"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ \App\Models\PenerimaanSkor::count() }}</h6>
                                            <span class="text-muted small pt-2 ps-1">Total Data</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Grafik Rata-rata Skor -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Skor</h5>
                                    <canvas id="skorChart" height="100"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<!-- Tambahkan Chart.js -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('skorChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Rumah', 'Kendaraan', 'Pekerjaan', 'Keluarga'],
                datasets: [{
                    label: 'Total Skor',
                    data: [
                        {{ \App\Models\PenerimaanSkor::avg('skor_rumah') ?? 0 }},
                        {{ \App\Models\PenerimaanSkor::avg('skor_kendaraan') ?? 0 }},
                        {{ \App\Models\PenerimaanSkor::avg('skor_pekerjaan') ?? 0 }},
                        {{ \App\Models\PenerimaanSkor::avg('skor_anak') ?? 0 }}
                        {{ \App\Models\PenerimaanSkor::avg('total_skor') ?? 0 }}
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.6)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
    });
</script>
@endpush
