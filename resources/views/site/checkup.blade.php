@extends('site.layouts.master')
@section('content')
    <main class="main">
        <section id="appointment" class="appointment section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Checkup Detail</h2>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                @if (session('success'))
                    <div role="alert" class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('failed'))
                    <div role="alert" class="alert alert-danger">{{ session('failed') }}</div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="card h-100 d-flex flex-column">
                            <div class="card-body flex-grow-1">
                                <div class="text-center mb-3">
                                    <h3>Detail Pemeriksaan</h3>
                                </div>
                                <div class="row">
                                    <div class="col-6">No.RM</div>
                                    <div class="col-6">: {{$checkup->user->rm}}</div>
                                    <div class="col-6">Nama Pasien</div>
                                    <div class="col-6">: {{$checkup->user->name}}</div>
                                    <div class="col-6">Umur</div>
                                    <div class="col-6">: {{ \Carbon\Carbon::parse($checkup->user->birth_date)->age }} Tahun</div>
                                    <div class="col-6">Nama Dokter</div>
                                    <div class="col-6">: {{$checkup->schedule->user->name}}</div>
                                    <div class="col-6">Tanggal Periksa</div>
                                    <div class="col-6">: {{tanggal($checkup->created_at)}}</div>
                                    <div class="col-6">Status</div>
                                    <div class="col-6">: 
                                        @php
                                            $status = $checkup->checkup_status();
                                            $statusClass = match ($status) {
                                                'Pemeriksaan' => 'badge bg-warning text-dark',
                                                'Menunggu Obat' => 'badge bg-info',
                                                'Selesai' => 'badge bg-success',
                                                'Dibatalkan' => 'badge bg-danger',
                                                default => 'badge bg-secondary',
                                            };
                                        @endphp
                                        <span class="{{ $statusClass }}">
                                            <i class="fas fa-info-circle"></i> {{ $status }}
                                        </span>
                                    </div>
                                </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">Keluhan</div>
                                        <div class="col-6">: {{$checkup->complaint}}</div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">Diagnosis</div>
                                        <div class="col-6">: {{ $checkup->diagnosis ?: 'Belum ada diagnosis' }}</div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">Catatan Dokter</div>
                                        <div class="col-6">: {{ $checkup->note ?: 'Tidak ada catatan' }}</div>
                                    </div>
                                @if ($checkup->checkup_price)
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">Biaya Periksa</div>
                                        <div class="col-6">: {{rupiah($checkup->checkup_price)}}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if (authAs('doctor') && $checkup->status == 'checkup')
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        <h3>Diagnosis</h3>
                                    </div>
                                    <form action="/checkup/{{$checkup->id}}" method="post">
                                        @method('put')
                                        @csrf
                                        <div class="form-group mt-3">
                                            <label for="diagnosis">Diagnosis</label>
                                            <select name="diagnosis" id="diagnosis" class="form-select @error('diagnosis') is-invalid @enderror">
                                                <option value="">-- Pilih Diagnosis --</option>
                                                <option value="Demam" {{ $checkup->diagnosis == 'Demam' ? 'selected' : '' }}>Demam</option>
                                                <option value="Flu" {{ $checkup->diagnosis == 'Flu' ? 'selected' : '' }}>Flu</option>
                                                <option value="Infeksi Saluran Pernapasan" {{ $checkup->diagnosis == 'Infeksi Saluran Pernapasan' ? 'selected' : '' }}>Infeksi Saluran Pernapasan</option>
                                                <option value="Hipertensi" {{ $checkup->diagnosis == 'Hipertensi' ? 'selected' : '' }}>Hipertensi</option>
                                                <option value="Diabetes" {{ $checkup->diagnosis == 'Diabetes' ? 'selected' : '' }}>Diabetes</option>
                                            </select>
                                            @error('diagnosis')
                                                <div class="invalid-feedback">{{$message}}</div>
                                            @enderror
                                        </div>
                                    
                                        <div class="form-group mt-3">
                                            <label for="note">Catatan Tambahan</label>
                                            <textarea name="note" class="form-control @error('note') is-invalid @enderror"
                                                placeholder="Tambahkan informasi tambahan tentang diagnosis pasien...">{{ old('note', $checkup->note) }}</textarea>
                                            @error('note')
                                                <div class="invalid-feedback">{{$message}}</div>								
                                            @enderror
                                        </div>                                        
                                    
                                        <div class="form-group mt-3">
                                            <label for="medicine">Obat</label>
                                            <select id="medicine" class="form-select">
                                                <option value="">-- PILIH OBAT --</option>
                                                @foreach ($medicines as $medicine)
                                                    <option value="{{$medicine->id}}" data-name="{{$medicine->name}}" data-price="{{$medicine->price}}">
                                                        {{$medicine->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    
                                        <div id="medicines" class="mt-3"></div>
                                    
                                        <div class="mt-5">
                                            <div class="text-center"><button class="btn btn-primary" type="submit">Submit</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>                        
                    @endif
                    @if ($checkup->status != 'checkup')
                        <div class="col-md-6">
                            <div class="card h-100 d-flex flex-column">
                                <div class="card-body flex-grow-1">
                                    <div class="text-center mb-3">
                                        <h3>OBAT</h3>
                                    </div>
                                    <table class="table table-bordered">
                                        <thead class="text-center align-middle">
                                            <tr>
                                                <th>Nama Obat</th>
                                                <th>Aturan Pakai</th>
                                                <th>Jumlah Obat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($checkup->details as $detail)
                                                <tr>
                                                    <td class="text-center align-middle">{{$detail->medicine->name}}</td>
                                                    <td class="text-center align-middle">{{$detail->application}}</td>
                                                    <td class="text-center align-middle">{{$detail->qty}} Tablet</td>
                                                </tr>                                                
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                        
                    @endif
                </div>
                @if (authAs('doctor'))
                    <div class="text-center mt-5">
                        @php
                            $hasAccess = $checkup->user->accessRequests()
                                        ->where('doctor_id', auth()->id())
                                        ->where('status', 'approved')
                                        ->where('expires_at', '>', now()) // Pastikan akses masih berlaku
                                        ->exists();
                        @endphp
                        @if ($hasAccess)
                            <a href="/history/{{$checkup->user->id}}" class="btn btn-secondary">Lihat Riwayat Pemeriksaan</a>
                        @else
                            <button class="btn btn-primary request-access">Minta Akses Rekam Medis</button>
                        @endif
                    </div>
                @endif
                @if ($checkup->total_price && !authAs('patient'))
                <div class="text-center mt-5">                   
                    <h2 class="mb-5">Total Biaya <span class="badge text-bg-secondary">{{rupiah($checkup->total_price)}}</span></h2>
                    @if ($checkup->status == 'waiting_medicine')
                        <form action="/checkup/status/{{$checkup->id}}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="status" value="done">
                            <button type="submit" class="btn btn-primary">Klik disini untuk Selesai</button>
                        </form>
                    @elseif($checkup->status == 'done') 
                        <div class="text-success">Selesai</div>                       
                    @elseif($checkup->status == 'canceled') 
                        <div class="text-danger">Dibatalkan</div>                       
                    @endif
                </div>
                @endif
                @if ((!authAs('patient') && in_array($checkup->status, ['checkup', 'waiting_medicine'])) or (authAs('patient') && $checkup->status == 'checkup'))  
                    <div class="text-center mt-3">
                        <form action="/checkup/status/{{$checkup->id}}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="status" value="canceled">
                            <button type="submit" class="btn btn-danger">Klik disini untuk Cancel</button>
                        </form>                        
                    </div>                  
                @endif
            </div>
        </section>
    </main>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('.request-access').click(function () {
            $.ajax({
                url: '{{ route("medical-access.request", ["patientId" => $checkup->user->id]) }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message); // Respons sukses dari JSON
                },
                error: function(xhr) {
                    let errorMsg = xhr.responseJSON?.message || 'Terjadi kesalahan, coba lagi nanti.';
                    alert(errorMsg);
                }
            });
        });
    });
    $(document).ready(function () {
    $('#medicine').change(function () {
        let selected = $(this).find(':selected');
        let medicineId = selected.val();
        let medicineName = selected.data('name');

        if (!medicineId) return;

        // Cek apakah obat sudah dipilih sebelumnya
        if ($('#medicine-' + medicineId).length) {
            alert("Obat ini sudah ditambahkan!");
            return;
        }

        let html = `
            <div class="card p-2 mb-2" id="medicine-${medicineId}">
                <div class="d-flex justify-content-between align-items-center">
                    <strong>${medicineName}</strong>
                    <button type="button" class="btn btn-sm btn-danger remove-medicine">Hapus</button>
                </div>
                <div class="mt-2">
                    <input type="hidden" name="medicine_id[]" value="${medicineId}">
                    <input type="number" name="qty[]" placeholder="Jumlah" class="form-control" required>
                    <input type="text" name="application[]" placeholder="Aturan Pakai" class="form-control mt-2" required>
                </div>
            </div>
        `;

        $('#medicines').append(html);
        $('#medicine').val(""); // Reset dropdown setelah memilih obat
    });

    $(document).on('click', '.remove-medicine', function () {
        $(this).closest('.card').remove();
    });
});

</script>
@endsection
