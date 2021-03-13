<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.elements.head')
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            @include('admin.elements.slider')
        </div>
        <!-- top navigation -->list
        <div class="top_nav">
           @include('admin.elements.top_nav')
        </div>
        <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
            @yield('content')
        </div>
        <!-- /page content -->
        <!-- footer -->
        @include('admin.elements.footer')
        <!-- /footer -->
    </div>
</div>
    @include('admin.elements.scripts')
</body>
</html>