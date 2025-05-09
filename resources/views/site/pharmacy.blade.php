@extends('site.layouts.master')
@section('content')
    <main class="main">
        <section id="appointment" class="appointment section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Pharmacy</h2>
                <p>Apotek</p>
            </div>
            <div class="container">
                @if (session('success'))
                    <div role="alert" class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="card mt-4">
                    <div class="card-header">
                        <div class="card-title">Daftar Pemeriksaan</div>
                        <div class="card-tools">
                            <form action="" method="get" id="formSearch">
                              <div class="row">
                                <div class="col-md-6">                                          
                                  <div class="row">
                                    <div class="col-3">
                                      <div class="input-group input-group-sm" style="width: 150px;">
                                          <select name="statuses" class="form-select" id="statuses">
                                              <option value="all">All Status</option>
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
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">ID</th>
                                    <th>Pasien</th>
                                    <th>Dokter</th>
                                    <th>Schedule</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($checkups as $checkup)
                                    <tr>
                                        <td>{{$checkup->id}}</td>
                                        <td>{{$checkup->user->name}}</td>
                                        <td>{{$checkup->schedule->user->name}}</td>
                                        <td>{{ $checkup->schedule->hari() }} {{ waktu($checkup->schedule->start) }} - {{ waktu($checkup->schedule->finish) }}</td>
                                        <td>{{ $checkup->checkup_status() }}</td>
                                        <td>{{ tglwaktu($checkup->created_at) }}</td>
                                        <td>
                                            <a href="/checkup/{{$checkup->id}}" class="btn btn-sm btn-warning mb-2">Detail</a>
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

        </section>
    </main>
@endsection
@section('js')
<script>
	$(document).ready(function() {
		@if(old('id'))
			$('#editModal' + {!! old('id') !!}).modal('show')
		@endif

    $('#statuses').on('change', function(){
        $('#formSearch').submit();
    })

    $('.switchStatus').on('change', function(){
      $('#formStatus' + $(this).data('id')).submit();
    })
	});
</script>
@endsection
