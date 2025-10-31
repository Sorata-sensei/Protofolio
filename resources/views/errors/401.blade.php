@extends('errors::minimal')

@section('title', __('Unauthorized'))
{{-- @section('img', 'Unauthorized.png') --}}
@section('code', '401')
@section('message', __('Eh, bro! Kamu belum punya akses ke sini. Cek lagi izinmu, ya! 🚫😅'))
