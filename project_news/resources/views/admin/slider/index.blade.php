@extends('admin.main')
@section('content')
@php
    use App\Helpers\Template as Template;
    $buttonFilter = Template::showButtonFilter($controllerName,$coutByStatus,$params['filter']['status']);
    $searchArea = Template::showAreaSearch($controllerName,$params['search']);
@endphp
<div class="page-header zvn-page-header clearfix">
    <div class="zvn-page-header-title">
        <h3>Danh sách User</h3>
    </div>
    <div class="zvn-add-new pull-right">
        <a href="{{ route($controllerName. '/form') }}" class="btn btn-success"><i
                class="fa fa-plus-circle"></i> Thêm mới</a>
    </div>
</div>
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
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
                        {!! $searchArea !!}
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
