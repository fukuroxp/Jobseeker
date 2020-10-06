@extends('layouts.auth')

@section('content')
<section class="row flexbox-container">
    <div class="col-xl-8 col-11 d-flex justify-content-center">
        <div class="card bg-authentication rounded-0 mb-0">
            <div class="row m-0">
                <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                    <img src="{{ asset('app-assets/images/pages/login.png') }}" alt="branding logo">
                </div>
                <div class="col-lg-6 col-12 p-0">
                    <div class="card rounded-0 mb-0 px-2">
                        <div class="card-header pb-1">
                            <div class="card-title">
                                <h4 class="mb-0">Register</h4>
                            </div>
                        </div>
                        @include('flash::message')
                        <div class="card-content">
                            <div class="card-body pt-1">
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                        <input 
                                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                            oninput="this.setCustomValidity('')"
                                            type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" required>
                                        <div class="form-control-position">
                                            <i class="feather icon-user"></i>
                                        </div>
                                        <label for="name">Name</label>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                        <input 
                                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                            oninput="this.setCustomValidity('')"
                                            type="email" class="form-control @error('email') is-invalid @enderror" id="user-name" name="email" placeholder="Email" required>
                                        <div class="form-control-position">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <label for="user-name">Email</label>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-label-group position-relative input-divider-right">
                                        <input 
                                            oninvalid="this.setCustomValidity('Mohon diisi dengan lengkap')"
                                            oninput="this.setCustomValidity('')"
                                            type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                                        <div class="form-control-position">
                                            <i class="feather icon-eye" onmouseover="mouseoverPass();" onmouseout="mouseoutPass();"></i>
                                        </div>
                                        <label for="password">Password</label>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <fieldset class="form-label-group position-relative has-icon-left">
                                        <select class="form-control" name="role" id="role">
                                            <option value="HRD">Employeer / Perusahaan</option>
                                            <option value="Jobseeker">Jobseeker / Pelamar</option>
                                        </select>
                                        <div class="form-control-position">
                                            <i class="feather icon-user"></i>
                                        </div>
                                        <label for="role">Daftar Sebagai</label>
                                        @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </fieldset>
                                    <a href="{{ route('login') }}" class="btn btn-outline-primary float-left btn-inline">Login</a>
                                    <button type="submit" class="btn btn-primary float-right btn-inline">Register</button>
                                </form>
                            </div>
                        </div>
                        <div class="login-footer">
                            <div class="divider">
                                <div class="divider-text">Copyright &copy; 2020</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
