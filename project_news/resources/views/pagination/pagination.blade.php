@php
    $totalItems = $items->total();
    $totalPage  = $items->lastPage();
    $totalItemPerPage = $items->perPage();
@endphp

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Danh sách</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            @include('admin.slider.list')
        </div>
    </div>
</div>
</div>
<!--end-box-lists-->
<!--box-pagination-->
<div class="row">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Phân trang
            </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <div class="row">
                <div class="col-md-6">
                    <p class="m-b-0">Số phần tử trên trang: <b>{{ $totalItemPerPage }}</b> trên <span
                            class="label label-success label-pagination">{{$totalPage}} trang</span></p>
                </div>
                {{ $items->links('pagination.pagination-custom') }}
            </div>
        </div>
    </div>
</div>