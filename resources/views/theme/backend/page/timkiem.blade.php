@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/level.min.css')}}">
@endsection
@section('title')
    Thiên Ân tìm kiếm
    {{$data}}
@endsection

@section('content')
<h2 class="page-header">Tìm kiếm{{$data}}</h2>

    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom posr">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#listLevel" data-toggle="tab">Danh sách tìm kiếm ahy sinh viên</a></li>
                    @include('theme.backend.section.timkiem.search_khoa_school')
                    @include('theme.backend.section.timkiem.search_lop_school')
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="listLevel">
                        <a class="text-green cursor-pointer posa" data-lang="1" id="addLevel">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        @include('theme.backend.section.timkiem.table_sinhvien_school')
                        @include('theme.backend.section.timkiem.modal_sinhvien_school')
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    @include('theme.layout.backend.modal_confirm_delete')
@endsection

@section('script')
    <script src="{{asset('assets/backend/build/pages/js/timkiem.js')}}"></script>
@endsection