@extends('site.layouts.master')
@section('content')
    <main class="main">
        <section id="appointment" class="appointment section">
            <div class="container section-title" data-aos="fade-up">
                <h2>Setting</h2>
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
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <h3>Profile</h3>
                                </div>
                                <form action="/profile" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                            placeholder="Your Name" required="" value="{{old('name') ?? auth()->user()->name}}">
                                        @error('name')
                                            <div class="invalid-feedback">{{$message}}</div>								
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                            placeholder="Your Email" required="" value="{{old('email') ?? auth()->user()->email}}">
                                        @error('email')
                                            <div class="invalid-feedback">{{$message}}</div>								
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="phone">Phone</label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone"
                                            placeholder="Your Phone" required="" value="{{old('phone') ?? auth()->user()->phone}}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{$message}}</div>								
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="id_number">ID Number / KTP</label>
                                        <input type="tel" class="form-control @error('id_number') is-invalid @enderror" name="id_number" id="id_number"
                                            placeholder="Your ID Number / No.KTP" required="" value="{{old('id_number') ?? auth()->user()->id_number}}">
                                        @error('id_number')
                                            <div class="invalid-feedback">{{$message}}</div>								
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <div class="text-center"><button class="btn btn-primary" type="submit">Update Profile</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <h3>Change Password</h3>
                                </div>
                                <form action="/change-password" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="current_password">Current Password</label>
                                        <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" id="current_password"
                                            required="" value="{{old('current_password')}}">
                                        @error('current_password')
                                            <div class="invalid-feedback">{{$message}}</div>								
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="new_password">New Password</label>
                                        <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="new_password"
                                            required="" value="{{old('new_password')}}">
                                        @error('new_password')
                                            <div class="invalid-feedback">{{$message}}</div>								
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password"
                                            required="" value="{{old('confirm_password')}}">
                                        @error('confirm_password')
                                            <div class="invalid-feedback">{{$message}}</div>								
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <div class="text-center"><button class="btn btn-primary" type="submit">Update Password</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
