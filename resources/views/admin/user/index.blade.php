@extends('admin.layouts.master')

@section('title')
    Users
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
                        <h1>Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active">Users</li>
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
                                <h3 class="card-title"><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addModal">Add User</button></h3>
                                <div class="card-tools">
                                    <form action="" method="get" id="formSearch">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <select name="roles" class="form-control" id="roles">
                                                <option value="">All Roles</option>
                                                <option value="admin" @if(request('roles') == 'admin') selected @endif>Admin</option>
                                                <option value="doctor" @if(request('roles') == 'doctor') selected @endif>Doctor</option>
                                                <option value="pharmacist" @if(request('roles') == 'pharmacist') selected @endif>Pharmacist</option>
                                                <option value="patient" @if(request('roles') == 'patient') selected @endif>Patient</option>
                                            </select>
                                        </div>
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
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>ID Number</th>
                                            <th>RM</th>
                                            <th>Role</th>
                                            <th>Address</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                                                </td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->id_number }}</td>
                                                <td>{{ $user->rm }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>{{ tglwaktu($user->created_at) }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-warning mb-2" data-toggle="modal" data-target="#editModal{{$user->id}}"><i class="fa fa-pen"></i></a>
                                                    <a class="btn btn-sm btn-danger mb-2" data-toggle="modal" data-target="#deleteModal{{$user->id}}"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit-->
                                            <div class="modal fade" id="editModal{{$user->id}}" tabindex="-1" aria-labelledby="editModal{{$user->id}}Label" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="editModal{{$user->id}}Label">Edit {{ucfirst($user->role)}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <form action="/admin/users/{{$user->id}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                      <div class="deadline-form">
                                                        <div class="row g-3 mb-3">
                                                            <div class="col-sm-12">
                                                                <label for="role" class="form-label">Role</label>
                                                                <select name="role" id="role" class="form-control">
                                                                    @php
                                                                        $role = (old('id') == $user->id) ? old('role') : $user->role;
                                                                    @endphp
                                                                    <option value="admin" @if('admin' == $role) selected @endif>Admin</option>
                                                                    <option value="doctor" @if('doctor' == $role) selected @endif>Doctor</option>
                                                                    <option value="pharmacist" @if('pharmacist' == $role) selected @endif>Pharmacist/Apoteker</option>
                                                                    <option value="patient" @if('patient' == $role) selected @endif>Patient</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 mb-3">
                                                          <div class="col-sm-12">
                                                            <label for="name{{$user->id}}" class="form-label">Name</label>
                                                            <input type="text" name="name" class="form-control @if(old('id') == $user->id) @error('name') is-invalid @enderror @endif" id="name{{$user->id}}" value="@if(old('id') == $user->id){{old('name')}}@else{{$user->name}}@endif">
                                                            @if(old('id') == $user->id)
                                                                @error('name')
                                                                    <div class="invalid-feedback">{{$message}}</div>
                                                                @enderror
                                                            @endif								
                                                          </div>
                                                        </div>
                                                        <div class="row g-3 mb-3">
                                                          <div class="col-sm-12">
                                                            <label for="email{{$user->id}}" class="form-label">Email</label>
                                                            <input type="email" name="email" class="form-control @if(old('id') == $user->id) @error('email') is-invalid @enderror @endif" id="email{{$user->id}}" value="@if(old('id') == $user->id){{old('email')}}@else{{$user->email}}@endif">
                                                            @if(old('id') == $user->id)
                                                                @error('email')
                                                                    <div class="invalid-feedback">{{$message}}</div>
                                                                @enderror
                                                            @endif								
                                                          </div>
                                                        </div>
                                                        <div class="row g-3 mb-3">
                                                          <div class="col-sm-12">
                                                            <label for="phone{{$user->id}}" class="form-label">Phone</label>
                                                            <input type="text" name="phone" class="form-control @if(old('id') == $user->id) @error('phone') is-invalid @enderror @endif" id="phone{{$user->id}}" value="@if(old('id') == $user->id){{old('phone')}}@else{{$user->phone}}@endif">
                                                            @if(old('id') == $user->id)
                                                                @error('phone')
                                                                    <div class="invalid-feedback">{{$message}}</div>
                                                                @enderror
                                                            @endif								
                                                          </div>
                                                        </div>
                                                        <div class="row g-3 mb-3">
                                                          <div class="col-sm-12">
                                                            <label for="id_number{{$user->id}}" class="form-label">ID Number</label>
                                                            <input type="text" name="id_number" class="form-control @if(old('id') == $user->id) @error('id_number') is-invalid @enderror @endif" id="id_number{{$user->id}}" value="@if(old('id') == $user->id){{old('id_number')}}@else{{$user->id_number}}@endif">
                                                            @if(old('id') == $user->id)
                                                                @error('id_number')
                                                                    <div class="invalid-feedback">{{$message}}</div>
                                                                @enderror
                                                            @endif								
                                                          </div>
                                                        </div>
                                                        <div class="row g-3 mb-3">
                                                          <div class="col-sm-12">
                                                            <label for="rm{{$user->id}}" class="form-label">No.Rekam Medis</label>
                                                            <input type="text" name="rm" class="form-control @if(old('id') == $user->id) @error('rm') is-invalid @enderror @endif" id="rm{{$user->id}}" value="@if(old('id') == $user->id){{old('rm')}}@else{{$user->rm}}@endif" placeholder="Optional">
                                                            @if(old('id') == $user->id)
                                                                @error('rm')
                                                                    <div class="invalid-feedback">{{$message}}</div>
                                                                @enderror
                                                            @endif								
                                                          </div>
                                                        </div>
                                                        <div class="row g-3 mb-3">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="address{{$user->id}}">Address</label>
                                                                    <textarea name="address" class="form-control @if(old('id') == $user->id) @error('address') is-invalid @enderror @endif" id="address" rows="2">@if(old('id') == $user->id){{old('address')}}@else{{$user->address}}@endif</textarea>
                                                                    @if(old('id') == $user->id)
                                                                        @error('address')
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
                                            <div class="modal fade" id="deleteModal{{$user->id}}" tabindex="-1" aria-labelledby="deleteModal{{$user->id}}Label" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModal{{$user->id}}Label">Hapus {{ucfirst($user->name)}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <p>Apakah anda yakin ingin menghapus akun tersebut?</p>
                                                  </div>
                                                  <form action="/admin/users/{{$user->id}}" method="post">
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
                                {{ $users->links('admin.layouts.paginate') }}
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
                    <h5 class="modal-title" id="addModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/users" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="deadline-form">
                            <div class="row g-3 mb-3">
                                <div class="col-sm-12">
                                    <label for="role" class="form-label">Role</label>
                                    <select name="role" id="role" class="form-control">
                                        <option value="doctor" @if(old('role') == 'doctor') selected @endif>Doctor</option>
                                        <option value="pharmacist" @if(old('role') == 'pharmacist') selected @endif>Pharmacist/Apoteker</option>
                                        <option value="patient" @if(old('role') == 'patient') selected @endif>Patient</option>
                                    </select>
                                </div>
                            </div>
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
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="email" placeholder="Email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-12">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" placeholder="Phone">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-12">
                                    <label for="id_number" class="form-label">ID Number/KTP</label>
                                    <input type="text" name="id_number" value="{{ old('id_number') }}"
                                        class="form-control @error('id_number') is-invalid @enderror"
                                        id="id_number" placeholder="No.KTP">
                                    @error('id_number')
                                        <div class="invalid-feedback">{{ $message }}</div>                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="address" rows="2">{{old('address')}}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>                                        
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-12">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" name="password" value="{{ old('password') }}"
                                        class="form-control @error('password') is-invalid @enderror"
                                        id="password" placeholder="Kata Sandi">
                                    @error('password')
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

        $('#roles').on('change', function(){
            $('#formSearch').submit();
        })
	});
</script>
@endpush
