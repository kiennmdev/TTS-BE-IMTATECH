@extends('admin.layouts.master')

@section('title')
    Cập nhật danh mục: {{ $model->name }}
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Cập nhật danh mục</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.catalogues.index') }}">Danh mục</a></li>
                        <li class="breadcrumb-item active">Cập nhật</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <form action="{{ route('admin.catalogues.update', $model->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-7">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name:</label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter name"
                                            name="name" value="{{ $model->name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="cover" class="form-label">File:</label>
                                        <input type="file" class="form-control" id="cover" name="cover">
                                        <img src="{{ \Storage::url($model->cover) }}" alt="" width="100px">
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" value="1"
                                            name="is_active" @if ($model->is_active) checked @endif>
                                        <label class="form-check-label" for="exampleCheck1">Is active</label>
                                    </div>
                                </div>
                                <div class="col-5">
                                </div>
                                <div class="card-header align-items-center d-flex">
                                    <button type="submit" class="btn btn-success">Cập nhật</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
