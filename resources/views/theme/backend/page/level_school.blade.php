@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/level.min.css')}}">
@endsection

@section('content')
    <h2 class="page-header">Quản lý sinh viênbcccc</h2>

    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom posr">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#listLevel" data-toggle="tab">Danh sách sinh viên</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="listLevel">
                        <a class="text-green cursor-pointer posa" data-lang="1" id="addLevel">
                            <i class="fa fa-plus-square"></i>
                        </a>
                        @include('theme.backend.section.level_school.table_level_school')
                        @include('theme.backend.section.level_school.modal_level_school')
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
    <script src="{{asset('assets/backend/build/pages/js/level.js')}}"></script>
@endsection