@extends('admin.main')
@section('content')
@php
    use App\Helpers\Template as Template;
    $buttonFilter = Template::showButtonFilter($controllerName,$coutByStatus,$params['filter']['status']);
@endphp
<div class="page-header zvn-page-header clearfix">
    <div class="zvn-page-header-title">
        <h3>Danh sách User</h3>
    </div>
    <div class="zvn-add-new pull-right">
        <a href="/form" class="btn btn-success"><i
                class="fa fa-plus-circle"></i> Thêm mới</a>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Bộ lọc</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-6">
                        {!! $buttonFilter !!}
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button"
                                        class="btn btn-default dropdown-toggle btn-active-field"
                                        data-toggle="dropdown" aria-expanded="false">
                                    Search by All <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li><a href="#"
                                           class="select-field" data-field="all">Search by All</a></li>
                                    <li><a href="#"
                                           class="select-field" data-field="id">Search by ID</a></li>
                                    <li><a href="#"
                                           class="select-field" data-field="username">Search by Username</a>
                                    </li>
                                    <li><a href="#"
                                           class="select-field" data-field="fullname">Search by Fullname</a>
                                    </li>
                                    <li><a href="#"
                                           class="select-field" data-field="email">Search by Email</a></li>
                                </ul>
                            </div>
                            <input type="text" class="form-control" name="search_value" value="">
                            <span class="input-group-btn">
                        <button id="btn-clear" type="button" class="btn btn-success"
                                style="margin-right: 0px">Xóa tìm kiếm</button>
                        <button id="btn-search" type="button" class="btn btn-primary">Tìm kiếm</button>
                        </span>
                            <input type="hidden" name="search_field" value="all">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--box-lists-->
<div class="row">
    @if (count($items) > 0)
        @include('pagination.pagination')
    @endif
</div>
<!--end-box-pagination-->
@endsection
