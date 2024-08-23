@extends('admin.layouts.master')

@section('title')
    Danh sách bình luận
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Bình luận</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Bình luận</a></li>
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
                <div class="card-header">
                    <h4 class="card-title mb-0">Danh sách bình luận</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>

                                    <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i
                                            class="ri-delete-bin-2-line"></i></button>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <div class="search-box ms-2">
                                        <input type="text" class="form-control search" placeholder="Search...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll"
                                                    value="option">
                                            </div>
                                        </th>
                                        <th class="sort" data-sort="customer_name">Khách hàng</th>
                                        <th class="sort" data-sort="email">Sản phẩm</th>
                                        <th class="sort" data-sort="phone">Nội dung</th>
                                        <th class="sort" data-sort="date">Thời gian</th>
                                        <th class="sort" data-sort="status">Trạng thái</th>
                                        <th class="sort" data-sort="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($comments as $comment)
                                        <tr>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="chk_child"
                                                        value="option1">
                                                </div>
                                            </th>
                                            <td class="id" style="display:none;"><a href="javascript:void(0);"
                                                    class="fw-medium link-primary"></a></td>
                                            <td class="customer_name">{{ $comment->user->name }}</td>
                                            <td class="email">{{ $comment->product->name }}</td>
                                            <td class="phone">{{ $comment->content }}</td>
                                            <td class="date">{{ $comment->created_at }}</td>
                                            <td class="status">
                                                @if ($comment->deleted_at === null)
                                                    <span
                                                        class="badge bg-success-subtle text-success text-uppercase">Active</span>
                                                @else
                                                    <span
                                                        class="badge bg-danger-subtle text-danger text-uppercase">Block</span>
                                                @endif

                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <button class="btn btn-sm btn-soft-info edit-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#showModal{{ $comment->id }}"><i
                                                            class="ri-edit-2-line"></i></button>
                                                    </div>
                                                    <div class="remove">
                                                        <form action="{{route('admin.comments.restore', $comment->id)}}" method="post">
                                                            @csrf
                                                            <button class="btn btn-sm btn-soft-success remove-item-btn" type="submit"><i class="ri-eye-line"></i></button>
                                                        </form>
                                                    </div>
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-soft-danger remove-item-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteRecordModal{{ $comment->id }}"><i class="ri-eye-close-line"></i></button>
                                                    </div>
                                                    
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="showModal{{ $comment->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light p-3">
                                                        <h5 class="modal-title">Chi tiết</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close" id="close-modal"></button>
                                                    </div>
                                                    <form class="tablelist-form" autocomplete="off">
                                                        <div class="modal-body">
                                                            <div class="mb-3" id="modal-id" style="display: none;">
                                                                <label for="id" class="form-label">ID</label>
                                                                <input type="text" id="id" class="form-control"
                                                                    placeholder="ID" readonly
                                                                    value="{{ $comment->id }}" />
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="customername" class="form-label">Khách
                                                                    hàng</label>
                                                                <input type="text" id="customername"
                                                                    class="form-control" placeholder="Enter Name" readonly
                                                                    value="{{ $comment->user->name }}" />
                                                                <div class="invalid-feedback">Please enter a customer name.
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Sản phẩm</label>
                                                                <input type="text" id="" class="form-control"
                                                                    value="{{ $comment->product->name }}" readonly />
                                                                <div class="invalid-feedback">Please enter an email.</div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="phone" class="form-label">Nội dung</label>
                                                                <textarea name="" id="" cols="30" rows="10" class="form-control" readonly>{{ $comment->content }}</textarea>
                                                                <div class="invalid-feedback">Please enter a phone.</div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="date" class="form-label">Thời gian</label>
                                                                <input type="text" id="date" class="form-control"
                                                                    readonly value="{{ $comment->created_at }}" />
                                                                <div class="invalid-feedback">Please select a date.</div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="hstack gap-2 justify-content-end">
                                                                <button type="button" class="btn btn-light"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="button" type="submit"
                                                                    class="btn btn-success" id="edit-btn">Update</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade zoomIn" id="deleteRecordModal{{ $comment->id }}"
                                            tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close" id="btn-close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mt-2 text-center">
                                                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json"
                                                                trigger="loop" colors="primary:#f7b84b,secondary:#f06548"
                                                                style="width:100px;height:100px"></lord-icon>
                                                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                                <h4>Bạn chắc chắn ?</h4>
                                                                <p class="text-muted mx-4 mb-0">Bạn có chắc muốn ẩn bình luận này ?</p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                            <form
                                                                action="{{ route('admin.comments.sortdelete', $comment) }}"
                                                                method="post">
                                                                @csrf
                                                                <button type="button" type="button"
                                                                    class="btn w-sm btn-light"
                                                                    data-bs-dismiss="modal">Đóng</button>
                                                                <button type="submit" class="btn w-sm btn-danger "
                                                                    id="delete-record">Chắc chắn!</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end modal -->
                                    @endforeach


                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#121331,secondary:#08a88a"
                                        style="width:75px;height:75px"></lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                        orders for you search.</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                {{ $comments->links() }}
                            </div>
                        </div>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection

@section('style-libs')
    <!-- Sweet Alert css-->
    <link href="{{ asset('theme/admin/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet"
        type="text/css" />
@endsection

@section('script-libs')
    <!-- prismjs plugin -->
    <script src="{{ asset('theme/admin/assets/libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/list.js/list.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>

    <!-- list.js min js -->
    <script src="{{ asset('theme/admin/assets/js/pages/listjs.init.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('theme/admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection
