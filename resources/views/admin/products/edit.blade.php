@extends('admin.layouts.master')

@section('title')
    Chỉnh sửa sản phẩm
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Chỉnh sửa sản phẩm</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <form id="createproduct-form" autocomplete="off" novalidate
        action="{{ route('admin.products.update', $productEdit->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Product Title</label>

                            <input type="text" class="form-control" id="product-title-input"
                                placeholder="Enter product title" name="name" required value="{{ $productEdit->name }}">
                            <div class="invalid-feedback">Please Enter a product title.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="product-title-input">Product Sku</label>
                            <input type="text" class="form-control" id="product-sku-input"
                                value="{{ $productEdit->sku }}" name="sku" required>
                            <div class="invalid-feedback">Please Enter a product sku.</div>
                        </div>

                        <div class="mt-3">
                            <label>Product Description</label>
                            <textarea class="form-control" id="content" rows="2" name="content">{{ $productEdit->content }}</textarea>
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
                                            <img src="{{ Storage::url($productEdit->img_thumbnail) }}" id="product-img"
                                                class="avatar-md h-auto" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>

                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">List Galleries</h4>
                                    <button type="button" class="btn btn-primary" id="addGallery">Thêm ảnh</button>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="row gy-4" id="boxGalleryImg">

                                            <div class="card">
                                                <div class="col-xxl-12 col-md-12 d-flex">
                                                    @foreach ($productEdit->galleries as $key => $gallery)
                                                        <div class="mx-2">
                                                            <div>
                                                                <img class="mt-3 {{ $gallery->status == 0 ? 'opacity-50' : '' }}"
                                                                    id="gallery_img_{{ $gallery->id }}"
                                                                    src="{{ \Storage::url($gallery->image) }}"
                                                                    alt="" width="100px">
                                                                <!-- Custom Checkboxes Color -->
                                                                <div class="form-check form-switch form-switch-secondary">
                                                                    <input type="hidden"
                                                                        name="product_galleries[edit-gallery][{{ $gallery->id }}]"
                                                                        value="0">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        role="switch"
                                                                        id="status_gallery_{{ $gallery->id }}"
                                                                        onclick="changeStatus('{{ $gallery->id }}')"
                                                                        value="1"
                                                                        name="product_galleries[edit-gallery][{{ $gallery->id }}]"
                                                                        {{ $gallery->status == 1 ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="status_gallery_{{ $gallery->id }}">Hiện/Ẩn</label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @endforeach
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
                    <div class="card-header align-items-center d-flex justify-content-between">
                        <h4 class="card-title mb-0 flex-grow-1">Thuộc Tính</h4>
                        <a href="#" class="float-end text-decoration-underline" data-bs-toggle="modal"
                            data-bs-target=".bs-example-modal-xl">Các Sản Phẩm Biến Thể</a>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="card">
                                    <h5 class="fs-14 mb-3">Chọn thuộc tính sản phẩm</h5>
                                    <div class="">
                                        <div class="d-flex justify-content-between">
                                            <div class="fs-14 mb-1">Màu sắc:</div>
                                            <a href="{{ route('admin.product.colors.index') }}"
                                                class="float-end text-decoration-underline">Thêm Màu Mới</a>
                                        </div>
                                        <div>
                                            <div class="color-container">
                                                @foreach ($colors as $color)
                                                    <div
                                                        class="border-color @foreach ($productEdit->variants as $variant)
                                                                @if ($color->id == $variant->product_color_id)
                                                                    selected-color
                                                                @endif @endforeach">
                                                        <div class="color-product" data-index="{{ $color->id }}"
                                                            style="background-color: {{ $color->code }};"></div>
                                                        <input type="checkbox" id="color{{ $color->id }}"
                                                            style="display: none;"
                                                            value="{{ "$color->id-$color->name" }}" class="color-ppt"
                                                            @foreach ($productEdit->variants as $variant)
                                                                @checked($color->id == $variant->product_color_id) @endforeach>
                                                    </div>
                                                @endforeach

                                            </div>
                                            <div id="errorPropertyColor" class="text-danger mb-3"></div>
                                        </div>
                                    </div>

                                    <div class="">
                                        <div class="d-flex justify-content-between">
                                            <div class="fs-14 mb-1">Kích Cỡ:</div>
                                            <a href="{{ route('admin.product.sizes.index') }}"
                                                class="float-end text-decoration-underline">Thêm Kích Cỡ Mới</a>
                                        </div>
                                        <div>
                                            <div class="color-container">
                                                @foreach ($sizes as $sizeID => $sizeName)
                                                    <div
                                                        class="border-size @foreach ($productEdit->variants as $variant)
                                                                @if ($sizeID == $variant->product_size_id)
                                                                    selected-size
                                                                @endif @endforeach">
                                                        <div class="size-product align-middle text-center"
                                                            data-index="{{ $sizeID }}">{{ $sizeName }}</div>
                                                        <input type="checkbox" id="size{{ $sizeID }}"
                                                            style="display: none;" value="{{ "$sizeID-$sizeName" }}"
                                                            class="size-ppt"
                                                            @foreach ($productEdit->variants as $variant)
                                                                @checked($sizeID == $variant->product_size_id) @endforeach>
                                                    </div>
                                                @endforeach

                                            </div>
                                            <div id="errorPropertySize" class="text-danger"></div>

                                        </div>
                                    </div>
                                    <div id="save-property" class="d-flex justify-content-end mb-2"><button
                                            type="button" class="btn btn-primary">Lưu thuộc tính</button></div>
                                </div>
                                <div class="">
                                    <button type="button" id="addProperty" class="btn btn-primary d-none mb-2"
                                        onclick="addBoxProperty()">Thêm biến thể</button>
                                    <div id="error-variant" class="text-danger"></div>
                                    <div id="properties" class="row"></div>
                                </div>

                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
                <!-- end card -->
                <div class="text-end mb-3">
                    <button type="submit" class="btn btn-success w-sm">Cập Nhật</button>
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
                            <select class="form-select" name="is_hot_deal" id="Hot Deal" data-choices
                                data-choices-search-false>
                                <option value="1" {{ $productEdit->is_hot_deal == 1 ? 'selected' : '' }}>Public
                                </option>
                                <option value="0" {{ $productEdit->is_hot_deal == 0 ? 'selected' : '' }}>Hidden
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="New" class="form-label">New</label>
                            <select class="form-select" name="is_new" id="New" data-choices
                                data-choices-search-false>
                                <option value="1" {{ $productEdit->is_new == 1 ? 'selected' : '' }}>Public</option>
                                <option value="0" {{ $productEdit->is_new == 0 ? 'selected' : '' }}>Hidden</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="Show Home" class="form-label">Show Home</label>
                            <select class="form-select" name="is_show_home" id="Show Home" data-choices
                                data-choices-search-false>
                                <option value="1"{{ $productEdit->is_show_home == 1 ? 'selected' : '' }}>Public
                                </option>
                                <option value="0"{{ $productEdit->is_show_home == 0 ? 'selected' : '' }}>Hidden
                                </option>
                            </select>
                        </div>

                        <div>
                            <label for="choices-publish-visibility-input" class="form-label">Visibility</label>
                            <select class="form-select" name="is_active" id="choices-publish-visibility-input"
                                data-choices data-choices-search-false>
                                <option value="1"{{ $productEdit->is_active == 1 ? 'selected' : '' }}>Public</option>
                                <option value="0"{{ $productEdit->is_active == 0 ? 'selected' : '' }}>Hidden</option>
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
                                value="{{ $productEdit->price_regular }}">
                        </div>
                        <div>
                            <label for="name" class="form-label">Price Sale</label>
                            <input type="number" class="form-control" id="name" name="price_sale"
                                value="{{ $productEdit->price_sale }}">
                        </div>
                    </div>
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Categories</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2"> <a href="{{ route('admin.catalogues.index') }}"
                                class="float-end text-decoration-underline">Add
                                New</a>Select product category</p>
                        <select class="form-select" id="choices-category-input" name="catalogue_id" data-choices
                            data-choices-search-false>
                            @foreach ($catalogues as $id => $name)
                                <option value="{{ $id }}"
                                    {{ $productEdit->id_catalogue == $id ? 'selected' : '' }}>{{ $name }}</option>
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
                                        <option value="{{ $id }}"
                                            @foreach ($productEdit->tags as $tag)
                                            {{ $tag->pivot->tag_id == $id ? 'selected' : '' }} @endforeach>
                                            {{ $name }}</option>
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
                        <h5 class="card-title mb-0">Vật Liệu</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">Thêm vật liệu cho sản phẩm</p>
                        <textarea class="form-control" placeholder="Nhập vật liệu sản phẩm" rows="3" name="material">{{ $productEdit->material }}</textarea>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Mô Tả Ngắn</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">Thêm mô tả ngắn cho sản phẩm</p>
                        <textarea class="form-control" placeholder="Nhập mô tả sản phẩm" rows="3" name="description">{{ $productEdit->description }}</textarea>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </form>
    <!--  Extra Large modal example -->
    <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">Danh Sách Sản Phẩm Biến Thể</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="alternative-pagination" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Màu</th>
                                                <th>Kích Cỡ</th>
                                                <th>Giá Thường</th>
                                                <th>Giá Sale</th>
                                                <th>Số Lượng</th>
                                                <th>Hình Ảnh</th>
                                                <th>Hoạt Động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>01</td>
                                                <td>
                                                </td>
                                                <td>$47,071.60</td>
                                                <td>BTC/USD</td>
                                                <td>$28,722.76</td>
                                                <td>$68,789.63</td>
                                                <td>$888,411,910</td>
                                                <td>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                    {{-- <table class="table table-bordered">
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
                                @php
                                    $url = '';
                                    $quantity = 0;
                                    foreach ($productEdit->variants as $variant) {
                                        if (
                                            $variant->product_size_id == $sizeID &&
                                            $variant->product_color_id == $colorID
                                        ) {
                                            $url = \Storage::url($variant->image);
                                            $quantity = $variant->quantity;
                                        }
                                    }
                                @endphp
                                <tr>

                                    @if ($check)
                                        <td class="text-center align-middle fs-4" rowspan="2">
                                            {{ $sizeName }}</td>
                                    @endif

                                    <td class="d-flex justify-content-center align-items-center">
                                        <div
                                            style="width: 40px; height: 40px; border-radius:50%; background-color: {{ $colorName }}">
                                        </div>
                                    </td>
                                    <td>
                                        <input type="number"
                                            name="product_variants[{{ $sizeID . '-' . $colorID }}][quantity]"
                                            id="" value="{{ $quantity }}" class="form-control">
                                    </td>
                                    <td>
                                        <input type="file"
                                            name="product_variants[{{ $sizeID . '-' . $colorID }}][image]" id=""
                                            class="form-control">
                                    </td>
                                    <td>
                                        <img src="{{ $url }}" alt="" width="50px">
                                    </td>
                                </tr>

                                @php
                                    $check = false;
                                @endphp
                            @endforeach
                        @endforeach
                    </table> --}}
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i
                            class="ri-close-line me-1 align-middle"></i> Đóng</a>
                    <button type="button" class="btn btn-primary ">Lưu Thay Đổi</button>
                </div>
            </form><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('style-libs')
    <!-- Plugins css -->
    <link href="{{ asset('theme/admin/assets/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />

    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

@endsection

@section('styles')
    <style>
        .color-container {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .color-product,
        .size-product {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            cursor: pointer;
            padding: 1px;
        }

        .border-color,
        .border-size {
            border: 1px solid #ddd;
            padding: 2px;
        }

        .selected-color,
        .selected-size {
            border: 0.5px solid rgb(84, 84, 84);
        }
    </style>
@endsection

@section('script-libs')
    <script src="https:////cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>

    <!-- ckeditor -->
    <script src="{{ asset('theme/admin/assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>

    <!-- dropzone js -->
    <script src="{{ asset('theme/admin/assets/libs/dropzone/dropzone-min.js') }}"></script>

    <script src="{{ asset('theme/admin/assets/js/pages/ecommerce-product-create.init.js') }}"></script>

    <!-- prismjs plugin -->
    <script src="{{ asset('theme/admin/assets/libs/prismjs/prism.js') }}"></script>

    <!-- Lord Icon -->
    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>

    <!-- Modal Js -->
    <script src="{{ 'theme/admin/assets/js/pages/modal.init.js' }}"></script>

      <!--datatable js-->
      <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
      <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  
      <script src="{{asset('theme/admin/assets/js/pages/datatables.init.js')}}"></script>
@endsection

@section('scripts')
    <script src="{{ asset('js/product-create.js') }}"></script>
@endsection
