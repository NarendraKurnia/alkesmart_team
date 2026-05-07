@php
    if (!session()->has('id_user')) {
        header('Location: ' . url('adminteam/login'));
        exit;
    }

    if (request()->is('adminteam/user') && session('pegawai_id') != 1) {
        header('Location: ' . url('adminteam/kamar'));
        exit;
    }

@endphp
@include('adminteam/layout/head')
@include('adminteam/layout/header')
@include('adminteam/layout/menu')
@include($content)
@include('adminteam/layout/footer')