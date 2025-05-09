@extends('site.layouts.master')
@section('content')
    <main class="main">
        <!-- Appointment Section -->
        <section id="appointment" class="appointment section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Halaman Pasien</h2>
                <p>Informasi Riwayat Pemeriksaan</p>
            </div>
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row d-flex align-items-stretch">
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <h3>Buat Janji Temu</h3>
                                </div>
                                <form action="/appointment" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="rm">No.Rekam Medis</label>
                                        <input type="text" name="rm" class="form-control @error('rm') is-invalid @enderror" id="rm" disabled
                                            placeholder="No.Rekam Medis" required="" value="{{auth()->user()->rm}}">
                                        @error('rm')
                                            <div class="invalid-feedback">{{$message}}</div>								
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="complaint">Complaint / Keluhan</label>
                                        <textarea class="form-control @error('complaint') is-invalid @enderror" name="complaint" id="complaint">{{old('complaint')}}</textarea>
                                        @error('complaint')
                                            <div class="invalid-feedback">{{$message}}</div>								
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="poly_id">Pilih Poli</label>
                                        <select name="poly_id" id="poly_id" class="form-select">
                                            @foreach ($polies as $poly)
                                                <option value="{{$poly->id}}" {{$poly->id == old('poly_id') ? 'selected' : ''}}>{{$poly->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="schedule">Pilih Jadwal Periksa</label>
                                        <select name="schedule" id="schedule" class="form-select @error('schedule') is-invalid @enderror">
                                        </select>
                                        @error('schedule')
                                            <div class="invalid-feedback">{{$message}}</div>								
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <div class="text-center"><button class="btn btn-primary" type="submit">Submit</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card h-100">
                            <div class="card-header">
                                <div class="card-tools">
                                    <form action="" method="get" id="formSearch">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="input-group input-group-sm" style="width: 150px;">
                                                            <select name="statuses" class="form-select" id="statuses">
                                                                <option value="">All Status</option>
                                                                <option value="checkup" @if(request('statuses') == 'checkup') selected @endif>Pemeriksaan</option>
                                                                <option value="waiting_medicine" @if(request('statuses') == 'waiting_medicine') selected @endif>Menunggu Obat</option>
                                                                <option value="done" @if(request('statuses') == 'done') selected @endif>Selesai</option>
                                                                <option value="canceled" @if(request('statuses') == 'canceled') selected @endif>Dibatalkan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <h5 class="card-title text-center m-3">Riwayat Pemeriksaan</h5>
                                <table class="table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Dokter</th>
                                            <th>Jadwal</th>
                                            <th>Status</th>
                                            <th>Tanggal Buat Janji</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center align-middle">
                                        @foreach ($checkups as $checkup)
                                            <tr>
                                                <td>{{$checkup->schedule->user->name}}</td>
                                                <td>{{ $checkup->schedule->hari() }} {{ waktu($checkup->schedule->start) }} - {{ waktu($checkup->schedule->finish) }}</td>
                                                <td>{{ $checkup->checkup_status() }}</td>
                                                <td>{{ tglwaktu($checkup->created_at) }}</td>
                                                <td>
                                                    <a href="/checkup/{{$checkup->id}}" class="btn btn-sm btn-warning m-2">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                {{ $checkups->links('admin.layouts.paginate') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="card h-100">
                            <div class="card-body table-responsive p-0">
                                <h5 class="card-title text-center m-3">Permintaan Akses Rekam Medis</h5>
                                <table class="table table-bordered">
                                    <thead class="text-center align-middle">
                                        <tr>
                                            <th>Dokter</th>
                                            <th>Pasien</th>
                                            <th>Status</th>
                                            <th>Tanggal Permintaan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center align-middle">
                                        @foreach ($medicalRequests as $request)
                                            <tr>
                                                <td>{{$request->doctor->name}}</td>
                                                <td>{{$request->patient->name}}</td>
                                                <td>
                                                    @if($request->status == 'pending')
                                                        <span class="badge bg-warning">Menunggu</span>
                                                    @elseif($request->status == 'approved')
                                                        <span class="badge bg-success">Disetujui</span>
                                                    @else
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @endif
                                                </td>
                                                <td>{{ tglwaktu($request->created_at) }}</td>
                                                <td>
                                                    @csrf
                                                    <button class="btn btn-sm btn-success approve-btn" data-id="{{ $request->id }}">Setujui</button>
                                                    <button class="btn btn-sm btn-danger reject-btn" data-id="{{ $request->id }}">Tolak</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

@section('js')
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        // Approve Request
        $('.approve-btn').click(function () {
            var requestId = $(this).data('id');
            $.ajax({
                url: "/medical-access/respond/" + requestId,
                type: "PUT",
                data: {
                    status: "approved",
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    Swal.fire({
                        title: "Berhasil!",
                        text: "Permintaan telah disetujui.",
                        icon: "success"
                    });
                    $('button[data-id="' + requestId + '"]').closest('tr').find('td:nth-child(4)').html('<span class="badge bg-success">Disetujui</span>');
                    $('button[data-id="' + requestId + '"]').closest('td').html('-'); // Hapus tombol
                },
                error: function (xhr) {
                    console.log("Error:", xhr.responseText);
                    Swal.fire({
                        title: "Error!",
                        text: "Terjadi kesalahan, coba lagi.",
                        icon: "error"
                    });
                }
            });
        });
        $('.reject-btn').click(function () {
            var requestId = $(this).data('id');
            $.ajax({
                url: "/medical-access/respond/" + requestId,
                type: "PUT",
                data: {
                    status: "rejected",
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    Swal.fire({
                        title: "Ditolak!",
                        text: "Permintaan telah ditolak.",
                        icon: "warning"
                    });
                    $('button[data-id="' + requestId + '"]').closest('tr').find('td:nth-child(4)').html('<span class="badge bg-danger">Ditolak</span>');
                    $('button[data-id="' + requestId + '"]').closest('td').html('-');
                },
                error: function (xhr) {
                    console.log("Error:", xhr.responseText);
                    Swal.fire({
                        title: "Error!",
                        text: "Terjadi kesalahan, coba lagi.",
                        icon: "error"
                    });
                }
            });
        });
        schedules();
        $('#poly_id').on('change', function(){
            schedules();
        });
        $('#statuses').on('change', function(){
            $('#formSearch').submit();
        });
        function schedules(){
            const poly_id = $('#poly_id').val();
            const schedule_id = `{{ old('schedule') }}`;
            $('#schedule').empty();
            $('#schedule').append(`<option value="">-- PILIH JADWAL --</option>`);
            if (poly_id) {
                $.get("/api/schedules/" + poly_id, function(data, status){
                    console.log("Jadwal Diterima:", data); // Debugging
                    data.forEach(schedule => {
                        $('#schedule').append(`<option value="${schedule.id}" ${schedule.id == schedule_id ? 'selected' : ''}>Dokter ${schedule.name} | ${schedule.day} | ${schedule.start} - ${schedule.finish}</option>`);
                    });
                }).fail(function(xhr) {
                    console.log("Error:", xhr.responseText); // Debugging
                });
            }
        }
        Pusher.logToConsole = true;
        var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
            cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
            encrypted: true
        });
        var channel = pusher.subscribe('private-medical-request.{{ auth()->id() }}');
        channel.bind('MedicalRequestUpdated', function(data) {
            Swal.fire({
                title: "Notifikasi!",
                text: "Ada permintaan akses rekam medis baru dari " + data.medicalRequest.doctor.name,
                icon: "info"
            }).then(() => {
                location.reload();
            });
        });
    });
</script>
@endsection
