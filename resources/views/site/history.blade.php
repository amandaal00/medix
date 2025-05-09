@extends('site.layouts.master')

@section('content')
<main class="main">
    <section id="appointment" class="appointment section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Riwayat</h2>
            <p>Riwayat Pemeriksaan</p>
        </div>

        <div class="container">
            @if (session('success'))
                <div role="alert" class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row justify-content-center">
                <!-- Profile Pasien -->
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <h3>Profile Pasien</h3>
                            </div>
                            <div class="row">
                                <div class="col-6">No.Rekam Medis</div>
                                <div class="col-6">: {{$user->rm}}</div>
                                <div class="col-6">Nama Pasien</div>
                                <div class="col-6">: {{$user->name}}</div>
                                <div class="col-6">Phone</div>
                                <div class="col-6">: {{$user->phone}}</div>
                                <div class="col-6">Alamat</div>
                                <div class="col-6">: {{$user->address}}</div>
                                <div class="col-6">Umur</div>
                                <div class="col-6">: {{ \Carbon\Carbon::parse($user->birth_date)->age }} Tahun</div>
                                <div class="col-6">Golongan Darah</div>
                                <div class="col-6">: {{$user->blood_type}}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Riwayat Pemeriksaan -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <h3>Riwayat Pemeriksaan</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-dark">
                                        <tr class="text-center align-middle">
                                            <th>Dokter</th>
                                            <th>Keluhan</th>
                                            <th>Catatan</th>
                                            <th>Obat</th>
                                            <th>Status</th>
                                            <th>Tanggal Periksa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($checkups as $checkup)
                                            <tr class="text-center align-middle">
                                                <td>{{$checkup->schedule->user->name}}</td>
                                                <td>{{ $checkup->complaint }}</td>
                                                <td>{{ $checkup->note }}</td>
                                                <td>
                                                    @foreach ($checkup->details as $detail)
                                                        <h6>
                                                            <span class="badge bg-primary">
                                                                {{$detail->medicine->name}} - {{$detail->qty}} {{$detail->medicine->unit}}
                                                            </span>
                                                        </h6>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @if ($checkup->checkup_status() == 'Dibatalkan')
                                                        <span class="badge bg-danger">Dibatalkan</span>
                                                    @elseif ($checkup->checkup_status() == 'Menunggu Obat')
                                                        <span class="badge bg-warning text-dark">Menunggu Obat</span>
                                                    @else
                                                        <span class="badge bg-success">{{ $checkup->checkup_status() }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ tglwaktu($checkup->created_at) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            {{ $checkups->links('admin.layouts.paginate') }}
                        </div>
                    </div>
                </div>                    
            </div>
        </div>
    </section>
</main>
@endsection
