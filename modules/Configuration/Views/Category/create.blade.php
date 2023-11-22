@extends('layouts.master')
@section('title')
    Categories
@endsection
@section('css')
    <!-- extra css -->
@endsection
@section('content')
    <x-breadcrumb title="Add Category" pagetitle="Products" />

    <div class="row">
        <div class="col-xxl-3">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Create Categories</h6>
                </div>
                <div class="card-body">
                    <form autocomplete="off" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation createCategory-form" id="createCategory-form" novalidate>
                        <div class="row">
                            <div class="col-xxl-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="categoryTitle" class="form-label">Category Title<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" id="categoryTitle" placeholder="Enter title"
                                        required>
                                    <div class="invalid-feedback">Please enter a category title.</div>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="slugInput" class="form-label">Slug <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="slug" class="form-control" id="slugInput" placeholder="Enter slug">
                                </div>
                            </div>
                            <div class="col-xxl-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="category-image-input" class="form-label d-block">Image <span
                                            class="text-danger">*</span></label>

                                    <div class="position-relative d-inline-block">
                                        <div class="position-absolute top-100 start-100 translate-middle">
                                            <label for="category-image-input" class="mb-0" data-bs-toggle="tooltip"
                                                data-bs-placement="right" title="Select Category Image">
                                                <span class="avatar-xs d-inline-block">
                                                    <span
                                                        class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                        <i class="ri-image-fill"></i>
                                                    </span>
                                                </span>
                                            </label>
                                            <input class="form-control d-none" id="category-image-input" type="file" name="attachment"
                                                accept="image/png, image/gif, image/jpeg">
                                        </div>
                                        <div class="avatar-lg">
                                            <div class="avatar-title bg-light rounded-3">
                                                <img src="#" alt="" id="category-img"
                                                    class="avatar-md h-auto rounded-3 object-fit-cover">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="error-msg mt-1">Please add a category images.</div>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-lg-6">
                                <div class="mb-3">
                                    <label for="descriptionInput" class="form-label">Description</label>
                                    <textarea class="form-control" name="description" id="descriptionInput" rows="3" placeholder="Description" required></textarea>
                                    <div class="invalid-feedback">Please enter a description.</div>
                                </div>
                            </div>
                            {!!csrf_field() !!}
                            <div class="col-xxl-12">
                                <div class="text-start">
                                    <button type="submit" class="btn btn-success">Add Category</button>
                                    <button type="reset" class="btn btn-primary">Reset</button>
                                </div>
                              
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div>
        <!--end col-->
    </div>
    <!--end row-->

@endsection

@section('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/backend/image-preview.js') }}"></script>
@endsection

