@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-content">
    {{-- 背景の大きなテキスト --}}
    <div class="thanks-background">
        <span>Thank you</span>
    </div>

    {{-- 中央のメッセージ --}}
    <div class="thanks-message">
        <p>お問い合わせありがとうございました</p>
        <div class="home-btn">
            <a href="/" class="btn-home">HOME</a>
        </div>
    </div>
</div>
@endsection
