@extends('admin.layouts.master')

@section('title')
    Medicine
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
                        <h1>Medicine</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active">Medicine</li>
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
                                <h3 class="card-title"><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addModal">Add Medicine</button></h3>
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
                                            <th>Unit</th>
                                            <th>Price</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($medicines as $medicine)
                                            <tr>
                                                <td>{{ $loop->iteration + ($medicines->currentPage() - 1) * $medicines->perPage() }}
                                                </td>
                                                <td>{{ $medicine->name }}</td>
                                                <td>{{ $medicine->unit }}</td>
                                                <td>{{ rupiah($medicine->price) }}</td>
                                                <td>{{ tglwaktu($medicine->created_at) }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-warning mb-2" data-toggle="modal" data-target="#editModal{{$medicine->id}}"><i class="fa fa-pen"></i></a>
                                                    <a class="btn btn-sm btn-danger mb-2" data-toggle="modal" data-target="#deleteModal{{$medicine->id}}"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit-->
                                            <div class="modal fade" id="editModal{{$medicine->id}}" tabindex="-1" aria-labelledby="editModal{{$medicine->id}}Label" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="editModal{{$medicine->id}}Label">Edit {{ucfirst($medicine->name)}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <form action="/admin/medicine/{{$medicine->id}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                      <div class="deadline-form">
                                                        <div class="row g-3 mb-3">
                                                          <div class="col-sm-12">
                                                            <label for="name{{$medicine->id}}" class="form-label">Name</label>
                                                            <input type="text" name="name" class="form-control @if(old('id') == $medicine->id) @error('name') is-invalid @enderror @endif" id="name{{$medicine->id}}" value="@if(old('id') == $medicine->id){{old('name')}}@else{{$medicine->name}}@endif">
                                                            @if(old('id') == $medicine->id)
                                                                @error('name')
                                                                    <div class="invalid-feedback">{{$message}}</div>
                                                                @enderror
                                                            @endif								
                                                          </div>
                                                        </div>
                                                        <div class="row g-3 mb-3">
                                                          <div class="col-sm-12">
                                                            <label for="unit{{$medicine->id}}" class="form-label">Unit</label>
                                                            <input type="text" name="unit" class="form-control @if(old('id') == $medicine->id) @error('unit') is-invalid @enderror @endif" id="unit{{$medicine->id}}" value="@if(old('id') == $medicine->id){{old('unit')}}@else{{$medicine->unit}}@endif">
                                                            @if(old('id') == $medicine->id)
                                                                @error('unit')
                                                                    <div class="invalid-feedback">{{$message}}</div>
                                                                @enderror
                                                            @endif								
                                                          </div>
                                                        </div>
                                                        <div class="row g-3 mb-3">
                                                          <div class="col-sm-12">
                                                            <label for="price{{$medicine->id}}" class="form-label">Price</label>
                                                            <input type="number" name="price" class="form-control @if(old('id') == $medicine->id) @error('price') is-invalid @enderror @endif" id="price{{$medicine->id}}" value="@if(old('id') == $medicine->id){{old('price')}}@else{{$medicine->price}}@endif">
                                                            @if(old('id') == $medicine->id)
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
                                            </div>
                      
                                            <!-- Modal Delete-->
                                            <div class="modal fade" id="deleteModal{{$medicine->id}}" tabindex="-1" aria-labelledby="deleteModal{{$medicine->id}}Label" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModal{{$medicine->id}}Label">Hapus {{ucfirst($medicine->name)}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus data tersebut?</p>
                                                  </div>
                                                  <form action="/admin/medicine/{{$medicine->id}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                      <button type="submit" class="btn btn-primary">Hapus</button>
                                                    </div>
                                                  </form>                            
                                                </div>
                                              </div>
                                            </div>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{ $medicines->links('admin.layouts.paginate') }}
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
                    <h5 class="modal-title" id="addModalLabel">Add Medicine</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/medicine" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="deadline-form">
                            <div class="row g-3 mb-3">
                                <div class="col-sm-12">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        id="name" placeholder="Name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-12">
                                    <label for="unit" class="form-label">Unit</label>
                                    <input type="text" name="unit" value="{{ old('unit') }}"
                                        class="form-control @error('unit') is-invalid @enderror"
                                        id="unit" placeholder="Unit/Kemasan">
                                    @error('unit')
                                        <div class="invalid-feedback">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-12">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" name="price" value="{{ old('price') }}"
                                        class="form-control @error('price') is-invalid @enderror"
                                        id="price" placeholder="Price">
                                    @error('price')
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
