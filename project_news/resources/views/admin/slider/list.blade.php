@php
    use App\Helpers\Template as Template;
@endphp

<div class="table-responsive">
    <table class="table table-striped jambo_table bulk_action">
        <thead>
        <tr class="headings">
            <th class="column-title">#</th>
            <th class="column-title">Slider Infor</th>
            <th class="column-title">Trạng thái</th>
            <th class="column-title">Tạo mới</th>
            <th class="column-title">Chỉnh sửa</th>
            <th class="column-title">Hành động</th>
        </tr>
        </thead>
        <tbody>
            @if (count($items) > 0)
                @foreach ($items as $key => $val)
                @php
                    $name           =   $val['name'];
                    $id             =   $val['id'];
                    $description    =   $val['description'];
                    $link           =   $val['link'];
                    $thumb          =   Template::showItemThumb($controllerName,$val['thumb'],$val['name']);
                    $created        =   $val['created'];
                    $created_by     =   $val['created_by'];
                    $modified       =   $val['modified'];
                    $modified_by    =   $val['modified_by'];
                    $status         =   Template::showItemStatus($controllerName,$val['status'],$id);
                @endphp
                <tr class="even pointer">
                    <td class="">{{ $id }}</td>
                    <td width="40%">
                        <p><strong>Name: </strong>{{ $name }}</p>
                        <p><strong>Description: </strong>{{ $description }}</p>
                        <p><strong>Link: </strong>{{ $link }}</p>
                        <p>{!! $thumb !!}</p>
                    </td>
                    <td>
                        {!! $status !!}
                    </td>
                    <td>
                        <p><i class="fa fa-user"></i> {{ $created_by }}</p>
                        <p><i class="fa fa-clock-o"></i> {{ $created }}</p>
                    </td>
                    <td>
                        <p><i class="fa fa-user"></i> {{ $modified_by }}</p>
                        <p><i class="fa fa-clock-o"></i> {{ $modified }}</p>
                    </td>
                    <td class="last">
                        <div class="zvn-box-btn-filter">
                            <a
                                    href="{{ route('slider/edit', ['id'=>$id]) }}"
                                    type="button" class="btn btn-icon btn-success" data-toggle="tooltip"
                                    data-placement="top" data-original-title="Edit">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="{{ route('slider/delete', ['id'=>$id]) }}"
                                type="button" class="btn btn-icon btn-danger btn-delete"
                                data-toggle="tooltip" data-placement="top"
                                data-original-title="Delete">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            @else
                @include('admin.templates.list_empty',["colspan" => 6])
            @endif
        </tbody>
    </table>
</div>