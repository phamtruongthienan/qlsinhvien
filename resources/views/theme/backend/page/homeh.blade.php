@extends('theme.layout.backend.main')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/pages/level.min.css')}}">
@endsection
@section('title')
    Thiên Ân
    {{$data}}
@endsection

@section('content')
<h2 class="page-header">Chào Mừng Bạn Đến Với Quản Lý Thông Tin Sinh Viên</h2>
@endsection
