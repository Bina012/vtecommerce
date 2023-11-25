<!-- JAVASCRIPT -->
<script src="{{ URL::asset('build/libs/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js') }}"></script>
<!-- Sweet Alerts js -->
<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Sweet alert init js-->
<script src="{{ URL::asset('build/js/pages/sweetalerts.init.js') }}"></script>
<script src="{{ URL::asset('build/js/plugins.js') }}"></script>
@if(session()->has('message.updated'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: '{{ session('message.updated') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@endif

@yield('scripts')