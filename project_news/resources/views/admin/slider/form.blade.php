@extends('admin.main')
@section('content')
@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    $statusValue = ['default'=>'Select status', 'active'=>'Active', 'inactive'=>'Inactive'];
    $hiddeninputID = Form::hidden('id', (isset($items['id'])) ? $items['id'] : null);
    $hiddeninputThumb = Form::hidden('thumb_current', (isset($items['thumb'])) ? $items['thumb'] : '');
    $elements = [
        [
            'label' => Form::label('name', 'Name', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']),
            'element' => Form::text('name', (isset($items['name'])) ? $items['name'] : '' , ['class'=>'form-control col-md-6 col-xs-12'] )
        ],
        [
            'label' => Form::label('description', 'Description', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']),
            'element' => Form::text('description', (isset($items['description'])) ? $items['description'] : '', ['class'=>'form-control col-md-6 col-xs-12'] )
        ],
        [
            'label' => Form::label('status', 'Status', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']),
            'element' => Form::select('status',$statusValue , (isset($items['status'])) ? $items['status'] : 'default', ['class' => 'form-control col-md-6 col-xs-12'])
        ],
        [
            'label' => Form::label('link', 'link', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']),
            'element' => Form::text('link', (isset($items['link'])) ? $items['link'] : '', ['class'=>'form-control col-md-6 col-xs-12'] )
        ],
        [
            'label' => Form::label('thumb', 'Thumb', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']),
            'element' => Form::file('thumb', ['class'=>'form-control col-md-6 col-xs-12'] ),
            'thumb' => (isset($items['thumb'])) ?  Template::showItemThumb($controllerName,$items['thumb'],$items['name']) : null,
            'type' => 'thumb'
        ],
        [
            'element' => $hiddeninputID .$hiddeninputThumb . Form::submit('Submit',['class'=>'btn btn-success']),
            'type' => 'btn-submit'
        ]
    ]

@endphp
<div class="page-header zvn-page-header clearfix">
    <div class="zvn-page-header-title">
        <h3>Quản lí Slider</h3>
    </div>
    <div class="zvn-add-new pull-right">
        <a href="{{ route($controllerName) }}" class="btn btn-info"><i class="fa fa-step-backward"></i> Quay về</a>
    </div>
</div>
    @include('admin.templates.error')
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Thêm mới</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    {!! Form::open([
                        'method' => 'POST',
                        'url' => route("$controllerName/save"),
                        'accept-charset' => "UTF-8",
                        'enctype' => "multipart/form-data",
                        'class' => "form-horizontal form-label-left",
                        'id' => 'main-form'
                    ]) !!}

                        {!! FormTemplate::show($elements) !!}

                    {!! Form::close() !!}
                    {{-- <form method="POST" action="http://proj_news.xyz/admin123/slider/save" accept-charset="UTF-8" enctype="multipart/form-data" class="form-horizontal form-label-left" id="main-form">
                        <input name="_token" type="hidden" value="m4wsEvprE9UQhk4WAexK6Xhg2nGQwWUOPsQAZOQ5">
                        <div class="form-group">
                           <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12">Name</label>
                           <div class="col-md-6 col-sm-6 col-xs-12">
                              <input class="form-control col-md-6 col-xs-12" name="name" type="text" value="Ưu đãi học phí" id="name">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="description" class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                           <div class="col-md-6 col-sm-6 col-xs-12">
                              <input class="form-control col-md-6 col-xs-12" name="description" type="text" value="Tổng hợp các trương trình ưu đãi học phí hàng tuần..." id="description">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="status" class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                           <div class="col-md-6 col-sm-6 col-xs-12">
                              <select class="form-control col-md-6 col-xs-12" id="status" name="status">
                                 <option value="default">Select status</option>
                                 <option value="active" selected="selected">Kích hoạt</option>
                                 <option value="inactive">Chưa kích hoạt</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="link" class="control-label col-md-3 col-sm-3 col-xs-12">Link</label>
                           <div class="col-md-6 col-sm-6 col-xs-12">
                              <input class="form-control col-md-6 col-xs-12" name="link" type="text" value="https://zendvn.com/uu-dai-hoc-phi-tai-zendvn/" id="link">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="thumb" class="control-label col-md-3 col-sm-3 col-xs-12">Thumb</label>
                           <div class="col-md-6 col-sm-6 col-xs-12">
                              <input class="form-control col-md-6 col-xs-12" name="thumb" type="file" id="thumb">
                              <p style="margin-top: 50px;"><img src="http://proj_news.xyz/images/slider/LWi6hINpXz.jpeg" alt="Ưu đãi học phí" class="zvn-thumb"></p>
                           </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                           <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                              <input name="id" type="hidden" value="3">
                              <input name="thumb_current" type="hidden" value="LWi6hINpXz.jpeg">
                              <input class="btn btn-success" type="submit" value="Save">
                           </div>
                        </div>
                     </form> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
