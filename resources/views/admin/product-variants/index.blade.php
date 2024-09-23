@extends('admin.layouts.master')

@section('title')
    Danh sách Sản Phẩm Biến Thể
@endsection

@section('content')
    <!-- start page title -->

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Danh sách Sản Phẩm Biến Thể</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sản Phẩm Biến Thể</a></li>
                        <li class="breadcrumb-item active">Danh sách</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Danh Sách Sản Phẩm Biến Thể</h5>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10px;">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                <th>ID</th>
                                <th>Hình Ảnh</th>
                                <th>Sản Phẩm</th>
                                <th>Màu</th>
                                <th>Kích Cỡ</th>
                                <th>Số Lượng</th>
                                <th>Giá Thường</th>
                                <th>Giá Sale</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($productVariants as $variant)
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                    </div>
                                </th>
                                <td>{{ $variant->id }}</td>
                                <td>
                                    <img src="{{ Storage::url($variant->image) }}" alt="" width="50px">
                                </td>
                                <td>{{ $variant->product->name }}</td>
                                <td>{{ $variant->color->name }}</td>
                                <td>{{ $variant->size->name }} </td>
                                <td>{{ $variant->quantity }} </td>
                                <td>{{ $variant->price_regular }} </td>
                                <td>{{ $variant->price_sale }}</td>
                                <td class="">
                                    <div class="d-inline">
                                        {{-- <a href="{{route('admin.product.edit', $variant)}}" class="btn btn-soft-warning"><i
                                            class="ri-edit-2-line"></i></a> --}}
                                    <form class="d-inline" action="{{route('admin.product.variant.destroy', $variant)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-soft-danger"
                                        onclick="return confirm('Muốn xóa không?')"><i class="ri-delete-bin-line"></i></button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->

    
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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

    <script>
        new DataTable("#example", {
            order: [
                [0, 'desc']
            ]
        });
    </script>
@endsection
