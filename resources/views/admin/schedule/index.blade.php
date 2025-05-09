@extends('admin.layouts.master')

@section('title')
    Schedule
@endsection

@push('style')
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>schedule</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active">Schedule</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                @if (session('success'))
                    <div role="alert" class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addModal">Add Schedule</button></h3>
                                <div class="card-tools">
                                    <form action="" method="get" id="formSearch">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="search" name="search" value="{{ request('search') }}"
                                                id="search" class="form-control float-right" placeholder="Cari">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Name</th>
                                            <th>Poly</th>
                                            <th>Day</th>
                                            <th>Start</th>
                                            <th>Finish</th>
                                            <th>Created At</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schedules as $schedule)
                                            <tr>
                                                <td>{{ $loop->iteration + ($schedules->currentPage() - 1) * $schedules->perPage() }}
                                                </td>
                                                <td>{{ $schedule->user->name }}</td>
                                                <td>{{ $schedule->poly->name }}</td>
                                                <td>{{ $schedule->day }}</td>
                                                <td>{{ waktu($schedule->start) }}</td>
                                                <td>{{ waktu($schedule->finish) }}</td>
                                                <td>{{ tglwaktu($schedule->created_at) }}</td>
                                                {{-- <td>
                                                    <a class="btn btn-sm btn-warning mb-2" data-toggle="modal" data-target="#editModal{{$schedule->id}}"><i class="fa fa-pen"></i></a>
                                                    <a class="btn btn-sm btn-danger mb-2" data-toggle="modal" data-target="#deleteModal{{$schedule->id}}"><i class="fa fa-trash"></i></a>
                                                </td> --}}
                                            </tr>

                                            <!-- Modal Edit-->
                                            {{-- <div class="modal fade" id="editModal{{$schedule->id}}" tabindex="-1" aria-labelledby="editModal{{$schedule->id}}Label" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="editModal{{$schedule->id}}Label">Edit {{ucfirst($schedule->name)}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <form action="/admin/medicine/{{$schedule->id}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                      <div class="deadline-form">
                                                        <div class="row g-3 mb-3">
                                                          <div class="col-sm-12">
                                                            <label for="name{{$schedule->id}}" class="form-label">Name</label>
                                                            <input type="text" name="name" class="form-control @if(old('id') == $schedule->id) @error('name') is-invalid @enderror @endif" id="name{{$schedule->id}}" value="@if(old('id') == $schedule->id){{old('name')}}@else{{$schedule->name}}@endif">
                                                            @if(old('id') == $schedule->id)
                                                                @error('name')
                                                                    <div class="invalid-feedback">{{$message}}</div>
                                                                @enderror
                                                            @endif								
                                                          </div>
                                                        </div>
                                                        <div class="row g-3 mb-3">
                                                          <div class="col-sm-12">
                                                            <label for="unit{{$schedule->id}}" class="form-label">Unit</label>
                                                            <input type="text" name="unit" class="form-control @if(old('id') == $schedule->id) @error('unit') is-invalid @enderror @endif" id="unit{{$schedule->id}}" value="@if(old('id') == $schedule->id){{old('unit')}}@else{{$schedule->unit}}@endif">
                                                            @if(old('id') == $schedule->id)
                                                                @error('unit')
                                                                    <div class="invalid-feedback">{{$message}}</div>
                                                                @enderror
                                                            @endif								
                                                          </div>
                                                        </div>
                                                        <div class="row g-3 mb-3">
                                                          <div class="col-sm-12">
                                                            <label for="price{{$schedule->id}}" class="form-label">Price</label>
                                                            <input type="number" name="price" class="form-control @if(old('id') == $schedule->id) @error('price') is-invalid @enderror @endif" id="price{{$schedule->id}}" value="@if(old('id') == $schedule->id){{old('price')}}@else{{$schedule->price}}@endif">
                                                            @if(old('id') == $schedule->id)
                                                                @error('price')
                                                                    <div class="invalid-feedback">{{$message}}</div>
                                                                @enderror
                                                            @endif								
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                      <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                  </form>
                                                </div>
                                              </div>
                                            </div> --}}
                      
                                            <!-- Modal Delete-->
                                            {{-- <div class="modal fade" id="deleteModal{{$schedule->id}}" tabindex="-1" aria-labelledby="deleteModal{{$schedule->id}}Label" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModal{{$schedule->id}}Label">Hapus {{ucfirst($schedule->name)}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus data tersebut?</p>
                                                  </div>
                                                  <form action="/admin/medicine/{{$schedule->id}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                      <button type="submit" class="btn btn-primary">Hapus</button>
                                                    </div>
                                                  </form>                            
                                                </div>
                                              </div>
                                            </div> --}}

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{ $schedules->links('admin.layouts.paginate') }}
                            </div>

                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- Modal Add-->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/schedule" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="deadline-form">
                            <div class="row g-3 mb-3">
                                <div class="col-sm-12">
                                    <label for="user_id" class="form-label">Doctor</label>
                                    <select class="form-control" name="user_id" id="user_id">
                                        @foreach ($doctors as $doctor)
                                            <option value="{{$doctor->id}}">{{$doctor->name}}</option>                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-12">
                                    <label for="poly_id" class="form-label">Poly</label>
                                    <select class="form-control" name="poly_id" id="poly_id">
                                        @foreach ($polies as $poly)
                                            <option value="{{$poly->id}}">{{$poly->name}}</option>                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-12">
                                    <label for="day" class="form-label">Hari</label>
                                    <select class="form-control" name="day" id="day">
                                        <option value="monday">senin</option>
                                        <option value="tuesday">selasa</option>
                                        <option value="wednesday">rabu</option>
                                        <option value="thursday">kamis</option>
                                        <option value="friday">jumat</option>
                                        <option value="saturday">sabtu</option>
                                        <option value="sunday">minggu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-12">
                                    <label for="start" class="form-label">Start / Jam Mulai</label>
                                    <input type="time" name="start" value="{{ old('start') }}"
                                        class="form-control @error('start') is-invalid @enderror"
                                        id="start" placeholder="Start / Jam Mulai">
                                    @error('start')
                                        <div class="invalid-feedback">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-12">
                                    <label for="finish" class="form-label">Finish / Jam Selesai</label>
                                    <input type="time" name="finish" value="{{ old('finish') }}"
                                        class="form-control @error('finish') is-invalid @enderror"
                                        id="finish" placeholder="finish / Jam Selesai">
                                    @error('finish')
                                        <div class="invalid-feedback">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
	$(document).ready(function() {
		@if($errors->any() && !old('id'))
			$('#addModal').modal('show')
		@endif
		@if(old('id'))
			$('#editModal' + {!! old('id') !!}).modal('show')
		@endif
	});
</script>
@endpush
