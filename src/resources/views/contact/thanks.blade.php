@extends('layouts.thanks')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks">
    <p class="thanks__bg">Thank you</p>

    <div class="thanks__inner">
        <p class="thanks__message">
            お問い合わせありがとうございました
        </p>

        <a href="/" class="thanks__button">
            HOME
        </a>
    </div>
</div>
@endsection