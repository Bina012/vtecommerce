@extends('components-layouts.master')
@section('title')
    Phosphor Icons
@endsection
@section('css')
    <!-- add extra css -->
@endsection
@section('content')
    <!-- page title -->
    <x-breadcrumb title="Phosphor Icons" pagetitle="Icons" />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <h4 class="card-title">Examples</h4>
                            <p class="text-muted mb-0">Use <code>&lt;i class="ph-**">&lt;/i></code> class.</p>
                        </div>
                        <div class="flex-shrink-0">
                            <select class="form-select" id="icon-select" aria-label="Default select example">
                                <option value="">All icons</option>
                                <option value="light">light</option>
                                <option value="thin">thin</option>
                                <option value="bold">bold</option>
                                <option value="fill">fill</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row icon-demo-content" id="iconList"></div>
                    <!-- end row -->
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection

@section('scripts')
    <!-- materialdesign icon js-->
    <script src="{{ URL::asset('build/js/pages/phosphor-icons.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
