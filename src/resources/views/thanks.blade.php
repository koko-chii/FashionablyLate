@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-content">
    <div class="thanks-background">
        <span>Thank you</span>
    </div>

    <div class="thanks-message">
        <p>お問い合わせありがとうございました</p>
        <div class="home-btn">
            <a href="/" class="btn-home">HOME</a>
        </div>
    </div>
</div>
@endsection
