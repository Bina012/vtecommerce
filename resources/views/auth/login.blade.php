@extends('layouts.master-auth')
@section('title') Login @endsection
@section('content')

    <div class="w-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="auth-card mx-lg-3">
                        <div class="card border-0 mb-0">
                            <div class="card-header bg-primary border-0">
                                <div class="row">
                                    <div class="col-lg-4 col-3">
                                        <img src="{{ URL::asset('build/images/auth/img-1.png') }}" alt=""
                                            class="img-fluid">
                                    </div>
                                    <div class="col-lg-8 col-9">
                                        <h1 class="text-white lh-base fw-lighter">Join Our Toner Store</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="text-muted fs-15">Sign in to continue to Toner.</p>
                                <div class="p-2">
                                    <form method="POST" action="{{ route('auth.login') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input id="email" type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                required autocomplete="email" autofocus
                                                placeholder="Enter your email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Password</label>
                                            <input id="password" type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required
                                                placeholder="Enter your password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $password }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="mt-4">
                                            <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                        </div>
                                    </form>

                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> eCommerce. Powered <i class="mdi mdi-heart text-danger"></i> by
                                v4Tech
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
@section('scripts')
    <script src="{{ URL::asset('build//js/pages/password-addon.init.js') }}"></script>
@endsection
