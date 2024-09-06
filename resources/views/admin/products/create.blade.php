@extends('admin.layouts.master')

@section('title')
    Thêm mới sản phẩm
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới sản phẩm</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <form id="createproduct-form" autocomplete="off" novalidate action="{{ route('admin.products.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Product Title</label>

                            <input type="text" class="form-control" id="product-title-input" value=""
                                placeholder="Enter product title" name="name" required>
                            <div class="invalid-feedback">Please Enter a product title.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Product Sku</label>
                            <input type="text" class="form-control" id="product-sku-input" value="{{ \Str::random(8) }}"
                                name="sku" required>
                            <div class="invalid-feedback">Please Enter a product sku.</div>
                        </div>

                        <div class="mt-3">
                            <label>Product Description</label>
                            <textarea class="form-control" id="content" rows="2" name="content"></textarea>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Gallery</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="fs-14 mb-1">Product Image</h5>
                            <p class="text-muted">Add Product main Image.</p>
                            <div class="text-center">
                                <div class="position-relative d-inline-block">
                                    <div class="position-absolute top-100 start-100 translate-middle">
                                        <label for="product-image-input" class="mb-0" data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Select Image">
                                            <div class="avatar-xs">
                                                <div
                                                    class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                    <i class="ri-image-fill"></i>
                                                </div>
                                            </div>
                                        </label>
                                        <input class="form-control d-none" value="" id="product-image-input"
                                            type="file" name="img_thumbnail">
                                    </div>
                                    <div class="avatar-lg">
                                        <div class="avatar-title bg-light rounded">
                                            <img src="" id="product-img" class="avatar-md h-auto" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>

                            <div class="card">
                                <div class="card-header justify-content-between align-items-center d-flex">
                                    <div>
                                        <h5 class="fs-14 mb-1">Product Gallery</h5>
                                        <p class="text-muted">Add Product Gallery Images.</p>
                                    </div>
                                    <button type="button" class="btn btn-primary" id="addGallery">Thêm ảnh</button>
                                </div>
                                <!-- end card header -->

                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="row gy-4" id="boxGalleryImg">

                                            <div class="col-xxl-6 col-md-6">

                                                <div>
                                                    <label for="gallery_1" class="form-label">Image gallery</label>
                                                    <input type="file" class="form-control" id="gallery_1"
                                                        name="product_galleries[]">
                                                </div>

                                            </div>
                                            <!--end row-->
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Biến thể</h4>
                    </div><!-- end card header -->
                    <div class="card-body" style="height: 300px; overflow: scroll">
                        <div class="live-preview">
                            <div class="row gy-4">

                                <table class="table table-bordered">
                                    <tr>
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Quantity</th>
                                        <th>Image</th>
                                    </tr>

                                    @foreach ($sizes as $sizeID => $sizeName)
                                        @php
                                            $check = true;
                                        @endphp

                                        @foreach ($colors as $colorID => $colorName)
                                            <tr>

                                                @if ($check)
                                                    <td class="text-center align-middle fs-4" rowspan="2">
                                                        {{ $sizeName }}</td>
                                                @endif

                                                <td class="d-flex justify-content-center align-items-center">
                                                    <div
                                                        style="width: 40px; height: 40px; background-color: {{ $colorName }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="number"
                                                        name="product_variants[{{ $sizeID . '-' . $colorID }}][quantity]"
                                                        id="" value="" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="file"
                                                        name="product_variants[{{ $sizeID . '-' . $colorID }}][image]"
                                                        id="" class="form-control">
                                                </td>
                                            </tr>

                                            @php
                                                $check = false;
                                            @endphp
                                        @endforeach
                                    @endforeach
                                </table>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
                <!-- end card -->
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Submit</button>
                </div>
            </div>
            <!-- end col -->

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Publish</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="Hot Deal" class="form-label">Hot Deal</label>
                            <select class="form-select" name="is_hot_deal" id="Hot Deal"
                                data-choices data-choices-search-false>
                                <option value="1" selected>Public</option>
                                <option value="0">Hidden</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="New" class="form-label">New</label>
                            <select class="form-select" name="is_new" id="New"
                                data-choices data-choices-search-false>
                                <option value="1" selected>Public</option>
                                <option value="0">Hidden</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="Show Home" class="form-label">Show Home</label>
                            <select class="form-select" name="is_show_home" id="Show Home"
                                data-choices data-choices-search-false>
                                <option value="1" selected>Public</option>
                                <option value="0">Hidden</option>
                            </select>
                        </div>

                        <div>
                            <label for="choices-publish-visibility-input" class="form-label">Visibility</label>
                            <select class="form-select" name="is_active" id="choices-publish-visibility-input"
                                data-choices data-choices-search-false>
                                <option value="1" selected>Public</option>
                                <option value="0">Hidden</option>
                            </select>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Price</h5>
                    </div>
                    <!-- end card body -->
                    <div class="card-body">
                        <div>
                            <label for="name" class="form-label">Price Regular</label>
                            <input type="number" class="form-control" id="name" name="price_regular"
                                value="0">
                        </div>
                        <div>
                            <label for="name" class="form-label">Price Sale</label>
                            <input type="number" class="form-control" id="name" name="price_sale" value="0">
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Categories</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2"> <a href="{{ route('admin.catalogues.create') }}"
                                class="float-end text-decoration-underline">Add
                                New</a>Select product category</p>
                        <select class="form-select" id="choices-category-input" name="catalogue_id" data-choices
                            data-choices-search-false>
                            @foreach ($catalogues as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Tags</h5>
                    </div>
                    <div class="card-body">
                        <div class="hstack gap-3 align-items-start">
                            <div class="flex-grow-1">
                                <select class="form-control" id="choices-multiple-remove-button" name="tags[]"
                                    data-choices data-choices-removeItem name="choices-multiple-remove-button" multiple>
                                    @foreach ($tags as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Material</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">Add material for product</p>
                        <textarea class="form-control" placeholder="Enter material for product" rows="3" name="material"></textarea>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Short Description</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">Add short description for product</p>
                        <textarea class="form-control" placeholder="Must enter minimum of a 100 characters" rows="3"
                            name="description"></textarea>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </form>
@endsection

@section('style-libs')
    <!-- Plugins css -->
    <link href="{{asset('theme/admin/assets/libs/dropzone/dropzone.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('script-libs')
    <script src="https:////cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>

    <!-- ckeditor -->
    <script src="{{ asset('theme/admin/assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>

    <!-- dropzone js -->
    <script src="{{ asset('theme/admin/assets/libs/dropzone/dropzone-min.js') }}"></script>

    <script src="{{ asset('theme/admin/assets/js/pages/ecommerce-product-create.init.js') }}"></script>
@endsection

@section('scripts')
    <script>
        CKEDITOR.replace('content');

        let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();

        let addGalleryBtn = document.getElementById('addGallery')

        addGalleryBtn.addEventListener('click', (e) => {

            let addGalleryElement = `<div id="box_${id}" class="col-xxl-6 col-md-6">
                
                <div>
                    <label for="gallery_${id}" class="form-label">Image gallery</label>
                    <div class="d-flex">
                        <input type="file" class="form-control" id="gallery_${id}"
                        name="product_galleries[]">
                        <button type="button" class="btn btn-danger" onclick="removeGalleryImg('box_${id}')"><span class="bx bx-trash"></span></button>
                    </div>
                </div>

            </div>`;

            let boxGalleryImg = document.getElementById('boxGalleryImg')

            $(boxGalleryImg).append(addGalleryElement);
        })

        function removeGalleryImg(param) {
            if (confirm('Bạn có muốn xóa không?')) {
                $(`#${param}`).remove()
            }
        }
    </script>
@endsection
