<!-- removeNotificationModal -->
<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="NotificationModalbtn-close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                        colors="primary:#f7b84b,secondary:#f06548"
                        style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete
                        It!</button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{route('admin.dashboard')}}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{asset('theme/admin/assets/images/logo-sm.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('theme/admin/assets/images/logo-dark.png')}}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{route('admin.dashboard')}}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{asset('theme/admin/assets/images/logo-sm.png')}}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{asset('theme/admin/assets/images/logo-light.png')}}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Mục lục</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('admin.dashboard')}}">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Tổng Quan</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
               

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('admin.catalogues.index')}}">
                        <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Danh Mục</span>
                    </a>
                </li> <!-- end Dashboard Menu -->


                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarProducts" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarProducts">
                        <i class="ri-product-hunt-line"></i> <span data-key="t-layouts">Sản Phẩm</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarProducts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.products.index')}}" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Danh Sách Sản Phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.product.variants.index')}}" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Danh Sách Biến Thể</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.product.colors.index')}}" target="_blank" class="nav-link"
                                    data-key="t-detached">Danh Sách Màu</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.product.sizes.index')}}" target="_blank" class="nav-link"
                                    data-key="t-detached">Danh Sách Kích Cỡ</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.product.tags.index')}}" target="_blank" class="nav-link"
                                    data-key="t-detached">Danh Sách Nhãn</a>
                            </li>                                                 
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarBanners" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarBanners">
                        <i class="ri-slideshow-line"></i> <span data-key="t-layouts">Banner</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarBanners">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.banners.index')}}" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Danh Sách</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.banners.create')}}" target="_blank" class="nav-link"
                                    data-key="t-detached">Thêm Mới</a>
                            </li>
                           
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarUsers" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarUsers">
                        <i class="ri-account-circle-line"></i> <span data-key="t-layouts">Người Dùng</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarUsers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.users.index')}}" target="_blank" class="nav-link"
                                    data-key="t-horizontal">Danh Sách</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.users.create')}}" target="_blank" class="nav-link"
                                    data-key="t-detached">Thêm Mới</a>
                            </li>
                           
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('admin.order.index')}}">
                        <i class="ri-shopping-cart-2-line"></i> <span data-key="t-layouts">Đơn Hàng</span>
                    </a>

                </li> <!-- end Dashboard Menu -->
                
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('admin.coupon.index')}}">
                        <i class="ri-coupon-2-line"></i> <span data-key="t-layouts">Mã Giảm Giá</span>
                    </a>

                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('admin.comments.index')}}">
                        <i class="bx bx-comment-detail"></i> <span data-key="t-layouts">Bình Luận</span>
                    </a>
                </li> <!-- end Dashboard Menu -->
            

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>