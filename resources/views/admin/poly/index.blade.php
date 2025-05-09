@extends('admin.layouts.master')

@section('title')
    Poly
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
                        <h1>Poly</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active">Poly</li>
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
                                <h3 class="card-title"><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addModal">Add Poly</button></h3>
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
                                            <th>Description</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($polies as $poly)
                                            <tr>
                                                <td>{{ $loop->iteration + ($polies->currentPage() - 1) * $polies->perPage() }}
                                                </td>
                                                <td>{{ $poly->name }}</td>
                                                <td>{{ $poly->description }}</td>
                                                <td>{{ tglwaktu($poly->created_at) }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-warning mb-2" data-toggle="modal" data-target="#editModal{{$poly->id}}"><i class="fa fa-pen"></i></a>
                                                    <a class="btn btn-sm btn-danger mb-2" data-toggle="modal" data-target="#deleteModal{{$poly->id}}"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit-->
                                            <div class="modal fade" id="editModal{{$poly->id}}" tabindex="-1" aria-labelledby="editModal{{$poly->id}}Label" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="editModal{{$poly->id}}Label">Edit {{ucfirst($poly->name)}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <form action="/admin/poly/{{$poly->id}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                      <div class="deadline-form">
                                                        <div class="row g-3 mb-3">
                                                          <div class="col-sm-12">
                                                            <label for="name{{$poly->id}}" class="form-label">Name</label>
                                                            <input type="text" name="name" class="form-control @if(old('id') == $poly->id) @error('name') is-invalid @enderror @endif" id="name{{$poly->id}}" value="@if(old('id') == $poly->id){{old('name')}}@else{{$poly->name}}@endif">
                                                            @if(old('id') == $poly->id)
                                                                @error('name')
                                                                    <div class="invalid-feedback">{{$message}}</div>
                                                                @enderror
                                                            @endif								
                                                          </div>
                                                        </div>
                                                        <div class="row g-3 mb-3">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="description{{$poly->id}}">Description</label>
                                                                    <textarea name="description" class="form-control @if(old('id') == $poly->id) @error('description') is-invalid @enderror @endif" id="description" rows="2">@if(old('id') == $poly->id){{old('description')}}@else{{$poly->description}}@endif</textarea>
                                                                    @if(old('id') == $poly->id)
                                                                        @error('description')
                                                                            <div class="invalid-feedback">{{$message}}</div>
                                                                        @enderror
                                                                    @endif								
                                                                </div>
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
                                            <div class="modal fade" id="deleteModal{{$poly->id}}" tabindex="-1" aria-labelledby="deleteModal{{$poly->id}}Label" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModal{{$poly->id}}Label">Hapus {{ucfirst($poly->name)}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus data tersebut?</p>
                                                  </div>
                                                  <form action="/admin/poly/{{$poly->id}}" method="post">
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
                                {{ $polies->links('admin.layouts.paginate') }}
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
                    <h5 class="modal-title" id="addModalLabel">Add Poly</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/poly" method="POST" enctype="multipart/form-data">
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
                                    <div class="form-group">
                                        <label for="description">description</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="2">{{old('description')}}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
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
