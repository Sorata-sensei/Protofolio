@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Waduh! Kamu nggak diizinin masuk ke sini. Coba cari jalan lain, ya!
    🚷😜'))
