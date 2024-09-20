@extends('admin.layouts.master')

@section('title')
    Danh sách đơn hàng
@endsection

@section('content')
    <div class="row">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Danh sách đơn hàng</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Đơn hàng</a></li>
                            <li class="breadcrumb-item active">Danh sách</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

        <!-- end page title -->


        <div class="row">
            <div class="col-lg-12">
                <div class="card" id="orderList">
                    <div class="card-header border-0">
                        <div class="row align-items-center gy-3">
                            <div class="col-sm">
                                <h5 class="card-title mb-0">Danh sách đơn hàng</h5>
                            </div>
                            {{-- <div class="col-sm-auto">
                                <div class="d-flex gap-1 flex-wrap">
                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target="#showModal"><i
                                            class="ri-add-line align-bottom me-1"></i> Create Order</button>
                                    <button type="button" class="btn btn-info"><i
                                            class="ri-file-download-line align-bottom me-1"></i> Import</button>
                                    <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()"><i
                                            class="ri-delete-bin-2-line"></i></button>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body border border-dashed border-end-0 border-start-0">
                        <form>
                            <div class="row g-3">
                                <div class="col-xxl-5 col-sm-6 mb-3">
                                    <div class="search-box">
                                        <input type="text" class="form-control search"
                                            placeholder="Search for order ID, customer, order status or something...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-sm-6">
                                    <div>
                                        <input type="text" class="form-control" data-provider="flatpickr"
                                            data-date-format="d M, Y" data-range-date="true" id="demo-datepicker"
                                            placeholder="Select date">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-sm-4">
                                    <div>
                                        <select class="form-control" data-choices data-choices-search-false
                                            name="choices-single-default" id="idStatus">
                                            <option value="">Status</option>
                                            <option value="all" selected>All</option>
                                            @foreach ($statusOrder as $key => $value)
                                                <option value="{{ $key }}">{{ $key }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-2 col-sm-4">
                                    <div>
                                        <select class="form-control" data-choices data-choices-search-false
                                            name="choices-single-default" id="idPayment">
                                            <option value="">Select Payment</option>
                                            <option value="all" selected>All</option>
                                            @foreach ($statusPayment as $key => $value)
                                                <option value="{{ $key }}">{{ $key }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-1 col-sm-4">
                                    <div>
                                        <button type="button" class="btn btn-primary w-100" onclick="SearchData();"> <i
                                                class="ri-equalizer-fill me-1 align-bottom"></i>
                                            Filters
                                        </button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                    <div class="card-body pt-0">
                        <div>
                            {{-- <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active All py-3" data-bs-toggle="tab" id="All" href="#home1"
                                        role="tab" aria-selected="true">
                                        <i class="ri-store-2-fill me-1 align-bottom"></i> All Orders
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-3 Delivered" data-bs-toggle="tab" id="Delivered" href="#delivered"
                                        role="tab" aria-selected="false">
                                        <i class="ri-checkbox-circle-line me-1 align-bottom"></i> Delivered
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-3 Pickups" data-bs-toggle="tab" id="Pickups" href="#pickups"
                                        role="tab" aria-selected="false">
                                        <i class="ri-truck-line me-1 align-bottom"></i> Pickups <span
                                            class="badge bg-danger align-middle ms-1">2</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-3 Returns" data-bs-toggle="tab" id="Returns" href="#returns"
                                        role="tab" aria-selected="false">
                                        <i class="ri-arrow-left-right-fill me-1 align-bottom"></i> Returns
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link py-3 Cancelled" data-bs-toggle="tab" id="Cancelled"
                                        href="#cancelled" role="tab" aria-selected="false">
                                        <i class="ri-close-circle-line me-1 align-bottom"></i> Cancelled
                                    </a>
                                </li>
                            </ul> --}}

                            <div class="table-responsive table-card mb-1">
                                <table class="table table-nowrap align-middle" id="orderTable">
                                    <thead class="text-muted table-light">
                                        <tr class="text-uppercase">
                                            <th scope="col" style="width: 25px;">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="checkAll"
                                                        value="option">
                                                </div>
                                            </th>
                                            <th class="sort" data-sort="id">Order ID</th>
                                            <th class="sort" data-sort="customer_name">Customer</th>
                                            <th class="sort" data-sort="product_name">Phone Number</th>
                                            <th class="sort" data-sort="date">Order Date</th>
                                            <th class="sort" data-sort="amount">Amount</th>
                                            <th class="sort" data-sort="payment">Payment Status</th>
                                            <th class="sort" data-sort="status">Delivery Status</th>
                                            <th class="sort" data-sort="city">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($orders as $order)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="checkAll"
                                                            value="option1">
                                                    </div>
                                                </th>
                                                <td class="id"><a href="apps-ecommerce-order-details.html"
                                                        class="fw-medium link-primary">{{ $order->id }}</a></td>
                                                <td class="customer_name">{{ $order->user_name }}</td>
                                                <td class="product_name">{{ $order->user_phone }}</td>
                                                <td class="date">
                                                    @php
                                                        [$dateOnly, $timeOnly] = explode(' ', $order->created_at);
                                                    @endphp
                                                    {{ $dateOnly }} <small
                                                        class="text-muted">{{ $timeOnly }}</small>
                                                </td>
                                                <td class="amount">{{ $order->total_price }}</td>
                                                <td class="payment">
                                                    @php
                                                        $color = 'secondary';
                                                        if ($order->status_payment == 'paid') {
                                                            $color = 'success';
                                                        }
                                                    @endphp
                                                    @foreach ($statusPayment as $key => $value)
                                                        @if ($order->status_payment == $key)
                                                            <span
                                                                class="badge bg-{{ $color }}-subtle text-{{ $color }} text-uppercase">{{ $value }}
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="status">
                                                    @php
                                                        $color = 'secondary';
                                                        if ($order->status_order == 'confirmed') {
                                                            $color = 'primary';
                                                        } elseif ($order->status_order == 'preparing_goods') {
                                                            $color = 'info';
                                                        } elseif ($order->status_order == 'shipping') {
                                                            $color = 'warning';
                                                        } elseif ($order->status_order == 'delivered') {
                                                            $color = 'success';
                                                        } elseif ($order->status_order == 'canceled') {
                                                            $color = 'danger';
                                                        }
                                                    @endphp
                                                    @foreach ($statusOrder as $key => $value)
                                                        @if ($order->status_order == $key)
                                                            <span
                                                                class="badge bg-{{ $color }}-subtle text-{{ $color }} text-uppercase">{{ $value }}
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <ul class="list-inline hstack mb-0">
                                                        <li class="list-inline-item" data-bs-toggle="tooltip"
                                                            data-bs-trigger="hover" data-bs-placement="top"
                                                            title="View">
                                                            <a href="{{ route('admin.order.detail', $order) }}"
                                                                class="btn btn-soft-info">
                                                                <i class=" ri-eye-line"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                            data-bs-trigger="hover" data-bs-placement="top"
                                                            title="Edit">
                                                            <a href="#showModal{{ $order->id }}"
                                                                data-bs-toggle="modal"
                                                                class="btn btn-soft-warning">
                                                                <i class="ri-edit-2-line"></i>
                                                            </a>
                                                        </li>
                                                        {{-- <li class="list-inline-item" data-bs-toggle="tooltip"
                                                            data-bs-trigger="hover" data-bs-placement="top"
                                                            title="Remove">
                                                            <a class="text-danger d-inline-block remove-item-btn"
                                                                data-bs-toggle="modal" href="#deleteOrder">
                                                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                                            </a>
                                                        </li> --}}
                                                    </ul>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="showModal{{ $order->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-light p-3">
                                                            <h5 class="modal-title" id="exampleModalLabel">&nbsp;</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"
                                                                id="close-modal"></button>
                                                        </div>
                                                        <form class="tablelist-form" autocomplete="off" action="{{route('admin.order.update', $order)}}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <input type="hidden" id="id-field" />

                                                                <div class="mb-3" id="modal-id">
                                                                    <label for="orderId" class="form-label">ID</label>
                                                                    <input type="text" id="orderId"
                                                                        class="form-control" value="{{ $order->id }}"
                                                                        readonly />
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="customername-field"
                                                                        class="form-label">Customer Name</label>
                                                                    <input type="text" id="customername-field"
                                                                        class="form-control"
                                                                        value="{{ $order->user_name }}" readonly required />
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="customername-field"
                                                                        class="form-label">Phone Number</label>
                                                                    <input type="text" id="customername-field"
                                                                        class="form-control"
                                                                        value="{{ $order->user_phone }}" readonly required />
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="date-field" class="form-label">Order
                                                                        Date</label>
                                                                    @php
                                                                        [$dateOnly, $timeOnly] = explode(
                                                                            ' ',
                                                                            $order->created_at,
                                                                        );
                                                                    @endphp
                                                                    <input type="date" id="date-field"
                                                                        class="form-control" data-provider="flatpickr"
                                                                        required data-date-format="d M, Y" data-enable-time
                                                                        required placeholder="Select date"
                                                                        value="{{ $dateOnly }}" readonly />
                                                                </div>

                                                                <div class="row gy-4 mb-3">
                                                                    <div class="col-md-6">
                                                                        <div>
                                                                            <label for="amount-field"
                                                                                class="form-label">Amount</label>
                                                                            <input type="text" id="amount-field"
                                                                                class="form-control"
                                                                                placeholder="Total amount"
                                                                                value="{{ $order->total_price }}"
                                                                                required readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div>
                                                                            <label for="payment-field"
                                                                                class="form-label">Payment
                                                                                Status</label>
                                                                            <select class="form-control" data-trigger
                                                                                name="status_payment" required
                                                                                id="payment-field">
                                                                                <option value="">Payment Status
                                                                                </option>
                                                                                @foreach ($statusPayment as $key => $value)
                                                                                    <option value="{{ $key }}" {{$order->status_payment === $key ? 'selected' : ''}}>
                                                                                        {{ $value }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div>
                                                                    <label for="delivered-status"
                                                                        class="form-label">Delivery Status</label>
                                                                    <select class="form-control" data-trigger
                                                                        name="status_order" required
                                                                        id="delivered-status">
                                                                        <option value="">Delivery Status</option>
                                                                        @foreach ($statusOrder as $key => $value)
                                                                            <option value="{{ $key }}" {{$order->status_order === $key ? 'selected' : ''}}>
                                                                                {{ $value }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="hstack gap-2 justify-content-end">
                                                                    <button type="button" class="btn btn-light"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-success"
                                                                        id="edit-btn">Update</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="noresult" style="display: none">
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                            colors="primary:#405189,secondary:#0ab39c"
                                            style="width:75px;height:75px"></lord-icon>
                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                        <p class="text-muted">We've searched more than 150+ Orders We did not find any
                                            orders for you search.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                {{ $orders->links() }}
                            </div>
                        </div>

                       

                    </div>
                </div>

            </div>
            <!--end col-->
        </div>



        {{-- <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Danh sách sản phẩm</h5>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Thêm mới</a>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User name</th>
                                <th>User email</th>
                                <th>User phone</th>
                                <th>Status order</th>
                                <th>Status payment</th>
                                <th>Total price</th>
                                <th>User address</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($orders as $order)
                        <td>{{$order->id}}</td>
                                <td>{{$order->user_name}}</td>
                                <td>{{$order->user_email}}</td>
                                <td>{{$order->user_phone}}</td>
                                <td>
                                    @foreach ($statusOrder as $key => $value)
                                        {{$order->status_order === $key ? $value : ''}}
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($statusPayment as $key => $value)
                                    {{$order->status_payment === $key ? $value : ''}}
                                @endforeach
                                </td>
                                <td>{{$order->total_price}}</td>
                                <td>{{$order->user_address}}</td>
                                <td>{{ $order->created_at }} </td>
                                <td>{{ $order->updated_at }} </td>

                                <td class="">
                                    <div class="d-inline">
                                        <a href="{{route('admin.order.detail', $order)}}" class="btn btn-primary">Xem chi tiết</a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row--> --}}
    @endsection

    {{-- @section('style-libs')
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

    <script>
        new DataTable("#example", {
            order: [
                [0, 'desc']
            ]
        });
    </script>
@endsection --}}

    @section('style-libs')
        <!-- Sweet Alert css-->
        <link href="{{ asset('theme/admin/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet"
            type="text/css" />
    @endsection

    @section('script-libs')
        <!-- list.js min js -->
        <script src="{{ asset('theme/admin/assets/libs/list.js/list.min.js') }}"></script>

        <!--list pagination js-->
        <script src="{{ asset('theme/admin/assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>

        <!-- ecommerce-order init js -->
        <script src="{{ asset('theme/admin/assets/js/pages/ecommerce-order.init.js') }}"></script>

        <!-- Sweet Alerts js -->
        <script src="{{ asset('theme/admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    @endsection
