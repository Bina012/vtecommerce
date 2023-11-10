@extends('layouts.master-auth')
@section('title')
    Reset Passowrd
@endsection
@section('css')
    <!-- extra css -->
@endsection
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
                                        <img src="{{ URL::asset('build/images/auth/img-1.png') }}" alt="" class="img-fluid">
                                    </div>
                                    <div class="col-lg-8 col-9">
                                        <h1 class="text-white lh-base fw-lighter">Forgot Password?</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="text-muted fs-15">Reset password with Toner.</p>

                                <div class="alert alert-borderless alert-warning text-center mb-2 mx-2" role="alert">
                                    Enter your email and instructions will be sent to you!
                                </div>
                                <div class="p-2">
                                    <form>
                                        <div class="mb-4">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email"
                                                placeholder="Enter your email or username" required />
                                        </div>

                                        <div class="text-center mt-4">
                                            <button class="btn btn-primary w-100" type="submit">Send Reset Link</button>
                                        </div>
                                    </form><!-- end form -->
                                </div>
                                <div class="mt-4 text-center">
                                    <p class="mb-0">Wait, I remember my password... <a href="auth-signin-basic"
                                            class="fw-semibold text-primary text-decoration-underline"> Click here </a> </p>
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
                                </script> Toner. Crafted with <i class="mdi mdi-heart text-danger"></i> by
                                Themesbrand
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
@section('scripts')
    <script src="{{ URL::asset('build/js/pages/password-addon.init.js') }}"></script>
@endsection
