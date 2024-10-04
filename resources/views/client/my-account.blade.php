@extends('client.layouts.master')

@section('title')
    My Account
@endsection

@section('content')
    <!-- Begin Kenne's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Shop Related</h2>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="active"><a href="{{ route('my.account') }}">My Account</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Kenne's Breadcrumb Area End Here -->
    <!-- Begin Kenne's Page Content Area -->
    <main class="page-content">
        <div class="account-page-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <ul class="nav myaccount-tab-trigger" id="account-page-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" id="account-dashboard-tab" data-bs-toggle="tab"
                                    href="#account-dashboard" role="tab" aria-controls="account-dashboard"
                                    aria-selected="false">Tổng quát</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="account-orders-tab" data-bs-toggle="tab"
                                    href="#account-orders" role="tab" aria-controls="account-orders"
                                    aria-selected="true">Danh sách đơn hàng</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" id="account-address-tab" data-bs-toggle="tab" href="#account-address"
                                    role="tab" aria-controls="account-address" aria-selected="false">Addresses</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" id="account-details-tab" data-bs-toggle="tab" href="#account-details"
                                    role="tab" aria-controls="account-details" aria-selected="false">Thông tin tài
                                    khoản</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="account-logout-tab" href="{{ route('logout') }}" role="tab"
                                    aria-selected="false" onclick="return confirm('Bạn có chắc muốn đăng xuất không?')">Đăng
                                    xuất</a>
                            </li>
                            @if (Auth::user()->type === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" id="account-logout-tab" href="{{ route('admin.dashboard') }}"
                                        role="tab" aria-selected="false">Quản trị website</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-lg-9">
                        <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
                            <div class="tab-pane fade" id="account-dashboard" role="tabpanel"
                                aria-labelledby="account-dashboard-tab">
                                <div class="myaccount-dashboard">
                                    <p>Xin chào <b>{{ Auth::user()->name }}</b></p>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="Avatar" class="rounded"
                                            width="100px">
                                        <div>
                                            <p>Số điện thoại: {{ Auth::user()->phone }}</p>
                                            <p>Địa chỉ: {{ Auth::user()->address }}</p>
                                        </div>
                                    </div>
                                    <p class="mt-2">Từ bảng điều khiển tài khoản của bạn, bạn có thể xem các đơn hàng gần
                                        đây, quản lý địa chỉ giao hàng và thanh toán và <a href="javascript:void(0)">chỉnh
                                            sửa mật khẩu và thông tin tài khoản của bạn</a>.</p>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="account-orders" role="tabpanel"
                                aria-labelledby="account-orders-tab">
                                <div class="myaccount-orders">
                                    <h4 class="small-title">MY ORDERS</h4>
                                    <nav>
                                        <div class="nav nav-tabs justify-content-between" id="nav-tab" role="tablist">
                                            <button class="nav-link active text-dark" id="nav-all-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-all" type="button" role="tab"
                                                aria-controls="nav-all" aria-selected="true">Tất cả</button>
                                            <button class="nav-link text-dark" id="nav-pending-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-pending" type="button" role="tab"
                                                aria-controls="nav-pending" aria-selected="true">Chờ xác nhận</button>
                                            <button class="nav-link text-dark" id="nav-confirmed-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-confirmed" type="button" role="tab"
                                                aria-controls="nav-confirmed" aria-selected="false">Đã xác nhận</button>
                                            <button class="nav-link text-dark" id="nav-preparing_goods-tab"
                                                data-bs-toggle="tab" data-bs-target="#nav-preparing_goods" type="button"
                                                role="tab" aria-controls="nav-preparing_goods"
                                                aria-selected="false">Chuẩn bị hàng</button>
                                            <button class="nav-link text-dark" id="nav-shipping-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-shipping" type="button" role="tab"
                                                aria-controls="nav-shipping" aria-selected="false">Vận chuyển</button>
                                            <button class="nav-link text-dark" id="nav-delivered-tab"
                                                data-bs-toggle="tab" data-bs-target="#nav-delivered" type="button"
                                                role="tab" aria-controls="nav-delivered" aria-selected="false">Hoàn
                                                thành</button>
                                            <button class="nav-link text-dark" id="nav-canceled-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-canceled" type="button" role="tab"
                                                aria-controls="nav-canceled" aria-selected="false">Đã hủy</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-all" role="tabpanel"
                                            aria-labelledby="nav-all-tab">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th>Đơn hàng</th>
                                                            <th>Ngày đặt</th>
                                                            <th>Trạng thái đơn hàng</th>
                                                            <th>Trạng thái thanh toán</th>
                                                            <th>Tổng giá</th>
                                                            <th></th>
                                                        </tr>
                                                        @foreach ($ordersAll as $order)
                                                            <tr>
                                                                <td>#{{ $order->id }}</td>
                                                                <td>{{ $order->created_at }}</td>
                                                                <td>{{ $statusOrder[$order->status_order] }}</td>
                                                                <td>{{ $statusPayment[$order->status_payment] }}</td>
                                                                <td>{{ number_format($order->total_price, 0, ',', '.') }}<sup>đ</sup>
                                                                </td>
                                                                <td class="d-flex">
                                                                    <a href="{{ route('order.detail', $order) }}"
                                                                        class="kenne-btn kenne-btn_sm"><span>Chi
                                                                            tiết</span></a>
                                                                    @if ($order->status_order == "pending" || $order->status_order == "confirmed")
                                                                        <a href="{{route('canceled.order', $order)}}" onclick="return confirm('Bạn có muốn hủy đơn hàng không?')" class="outline-danger kenne-btn kenne-btn_sm">Hủy đơn</a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-pending" role="tabpanel"
                                            aria-labelledby="nav-pending-tab">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th>Đơn hàng</th>
                                                            <th>Ngày đặt</th>
                                                            <th>Trạng thái đơn hàng</th>
                                                            <th>Trạng thái thanh toán</th>
                                                            <th>Tổng giá</th>
                                                            <th></th>
                                                        </tr>
                                                        @foreach ($ordersPending as $orderPending)
                                                            <tr>
                                                                <td>#{{ $orderPending->id }}</td>
                                                                <td>{{ $orderPending->created_at }}</td>
                                                                <td>{{ $statusOrder[$orderPending->status_order] }}</td>
                                                                <td>{{ $statusPayment[$orderPending->status_payment] }}
                                                                </td>
                                                                <td>{{ number_format($orderPending->total_price, 0, ',', '.') }}<sup>đ</sup>
                                                                </td>
                                                                <td class="d-flex"><a href="{{ route('order.detail', $orderPending) }}"
                                                                        class="kenne-btn kenne-btn_sm"><span>Chi
                                                                            tiết</span></a>
                                                                            @if ($orderPending->status_order == "pending" || $orderPending->status_order == "confirmed")
                                                                            <a href="{{route('canceled.order', $orderPending)}}" onclick="return confirm('Bạn có muốn hủy đơn hàng không?')" class="outline-danger kenne-btn kenne-btn_sm">Hủy đơn</a>
                                                                        @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-confirmed" role="tabpanel"
                                            aria-labelledby="nav-confirmed-tab">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th>Đơn hàng</th>
                                                            <th>Ngày đặt</th>
                                                            <th>Trạng thái đơn hàng</th>
                                                            <th>Trạng thái thanh toán</th>
                                                            <th>Tổng giá</th>
                                                            <th></th>
                                                        </tr>
                                                        @foreach ($ordersConfirmed as $orderConfirmed)
                                                            <tr>
                                                                <td>#{{ $orderConfirmed->id }}</td>
                                                                <td>{{ $orderConfirmed->created_at }}</td>
                                                                <td>{{ $statusOrder[$orderConfirmed->status_order] }}</td>
                                                                <td>{{ $statusPayment[$orderConfirmed->status_payment] }}
                                                                </td>
                                                                <td>{{ number_format($orderConfirmed->total_price, 0, ',', '.') }}<sup>đ</sup>
                                                                </td>
                                                                <td class="d-flex">
                                                                    <a href="{{ route('order.detail', $orderConfirmed) }}"
                                                                        class="kenne-btn kenne-btn_sm">
                                                                        <span>Chi tiết</span>
                                                                    </a>
                                                                    @if ($orderConfirmed->status_order == "pending" || $orderConfirmed->status_order == "confirmed")
                                                                    <a href="{{route('canceled.order', $orderConfirmed)}}" onclick="return confirm('Bạn có muốn hủy đơn hàng không?')" class="outline-danger kenne-btn kenne-btn_sm">Hủy đơn</a>
                                                                @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-preparing_goods" role="tabpanel"
                                            aria-labelledby="nav-preparing_goods-tab">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th>Đơn hàng</th>
                                                            <th>Ngày đặt</th>
                                                            <th>Trạng thái đơn hàng</th>
                                                            <th>Trạng thái thanh toán</th>
                                                            <th>Tổng giá</th>
                                                            <th></th>
                                                        </tr>
                                                        @foreach ($ordersPreparingGoods as $orderPreparingGoods)
                                                            <tr>
                                                                <td>#{{ $orderPreparingGoods->id }}</td>
                                                                <td>{{ $orderPreparingGoods->created_at }}</td>
                                                                <td>{{ $statusOrder[$orderPreparingGoods->status_order] }}
                                                                </td>
                                                                <td>{{ $statusPayment[$orderPreparingGoods->status_payment] }}
                                                                </td>
                                                                <td>{{ number_format($orderPreparingGoods->total_price, 0, ',', '.') }}<sup>đ</sup>
                                                                </td>
                                                                <td><a href="{{ route('order.detail', $orderPreparingGoods) }}"
                                                                        class="kenne-btn kenne-btn_sm"><span>Chi
                                                                            tiết</span></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-shipping" role="tabpanel"
                                            aria-labelledby="nav-shipping-tab">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th>Đơn hàng</th>
                                                            <th>Ngày đặt</th>
                                                            <th>Trạng thái đơn hàng</th>
                                                            <th>Trạng thái thanh toán</th>
                                                            <th>Tổng giá</th>
                                                            <th></th>
                                                        </tr>
                                                        @foreach ($ordersShipping as $orderShipping)
                                                            <tr>
                                                                <td>#{{ $orderShipping->id }}</td>
                                                                <td>{{ $orderShipping->created_at }}</td>
                                                                <td>{{ $statusOrder[$orderShipping->status_order] }}</td>
                                                                <td>{{ $statusPayment[$orderShipping->status_payment] }}
                                                                </td>
                                                                <td>{{ number_format($orderShipping->total_price, 0, ',', '.') }}<sup>đ</sup>
                                                                </td>
                                                                <td><a href="{{ route('order.detail', $orderShipping) }}"
                                                                        class="kenne-btn kenne-btn_sm"><span>Chi
                                                                            tiết</span></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-delivered" role="tabpanel"
                                            aria-labelledby="nav-delivered-tab">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th>Đơn hàng</th>
                                                            <th>Ngày đặt</th>
                                                            <th>Trạng thái đơn hàng</th>
                                                            <th>Trạng thái thanh toán</th>
                                                            <th>Tổng giá</th>
                                                            <th></th>
                                                        </tr>
                                                        @foreach ($ordersDelivered as $orderDelivered)
                                                            <tr>
                                                                <td>#{{ $orderDelivered->id }}</td>
                                                                <td>{{ $orderDelivered->created_at }}</td>
                                                                <td>{{ $statusOrder[$orderDelivered->status_order] }}</td>
                                                                <td>{{ $statusPayment[$orderDelivered->status_payment] }}
                                                                </td>
                                                                <td>{{ number_format($orderDelivered->total_price, 0, ',', '.') }}<sup>đ</sup>
                                                                </td>
                                                                <td><a href="{{ route('order.detail', $orderDelivered) }}"
                                                                        class="kenne-btn kenne-btn_sm"><span>Chi
                                                                            tiết</span></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-canceled" role="tabpanel"
                                            aria-labelledby="nav-canceled-tab">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th>Đơn hàng</th>
                                                            <th>Ngày đặt</th>
                                                            <th>Trạng thái đơn hàng</th>
                                                            <th>Trạng thái thanh toán</th>
                                                            <th>Tổng giá</th>
                                                            <th></th>
                                                        </tr>
                                                        @foreach ($ordersCanceled as $orderCanceled)
                                                            <tr>
                                                                <td>#{{ $orderCanceled->id }}</td>
                                                                <td>{{ $orderCanceled->created_at }}</td>
                                                                <td>{{ $statusOrder[$orderCanceled->status_order] }}</td>
                                                                <td>{{ $statusPayment[$orderCanceled->status_payment] }}
                                                                </td>
                                                                <td>{{ number_format($orderCanceled->total_price, 0, ',', '.') }}<sup>đ</sup>
                                                                </td>
                                                                <td><a href="{{ route('order.detail', $orderCanceled) }}"
                                                                        class="kenne-btn kenne-btn_sm"><span>Chi
                                                                            tiết</span></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            {{-- <div class="tab-pane fade" id="account-address" role="tabpanel"
                                aria-labelledby="account-address-tab">
                                <div class="myaccount-address">
                                    <p>The following addresses will be used on the checkout page by default.</p>
                                    <div class="row">
                                        <div class="col">
                                            <h4 class="small-title">Billing Adress</h4>
                                            <address>
                                                1234 Heaven Stress, Beverly Hill OldYork UnitedState of Lorem
                                            </address>
                                        </div>
                                        <div class="col">
                                            <h4 class="small-title">Shipping Address</h4>
                                            <address>
                                                1234 Heaven Stress, Beverly Hill OldYork UnitedState of Lorem
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="tab-pane fade" id="account-details" role="tabpanel"
                                aria-labelledby="account-details-tab">
                                <div class="myaccount-details">
                                    <form action="{{ route('user.update', Auth::user()) }}" class="kenne-form"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="kenne-form-inner">
                                            <div class="single-input">
                                                <label for="account-details-firstname">Your Name*</label>
                                                <input type="text" id="account-details-firstname"
                                                    value="{{ Auth::user()->name }}" name="name">
                                            </div>
                                            <div class="single-input">
                                                <input type="file" id="account-details-firstname" name="avatar"
                                                    height="100%">
                                                <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="Avatar"
                                                    class="rounded" width="100px">
                                            </div>
                                            <div class="single-input">
                                                <label for="account-details-email">Email*</label>
                                                <input type="email" id="account-details-email"
                                                    value="{{ Auth::user()->email }}" name="email">
                                            </div>
                                            <div class="single-input">
                                                <label for="account-details-oldpass">Phone number</label>
                                                <input type="text" id="account-details-oldpass"
                                                    value="{{ Auth::user()->phone }}" name="phone">
                                            </div>
                                            <div class="single-input">
                                                <label for="account-details-newpass">Address</label>
                                                <input type="text" id="account-details-newpass"
                                                    value="{{ Auth::user()->address }}" name="address">
                                            </div>
                                            <div class="single-input">
                                                <button class="kenne-btn kenne-btn_dark" type="submit"
                                                    onclick="return confirm('Bạn có chắc muốn cập nhật thông tin tài khoản ?')"><span>SAVE
                                                        CHANGES</span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Kenne's Account Page Area End Here -->
    </main>
@endsection

@section('styles')
<style>
    .outline-danger{
        color: red !important;
        border: 1px solid red !important;
        background: white !important;
        border: none !important;
        font-size: 0.7rem !important;
    }
    .outline-danger:hover{
        text-decoration: underline !important;
    }
    .kenne-btn_sm{
        width: 60px !important;
    }
</style>
@endsection