@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')

<div class="confirm__content">
    <div class="confirm__heading">
        <h2>お問い合わせ内容確認</h2>
    </div>

    <div class="confirm__table">
        <table>
            <tr>
                <th>お名前</th>
                <td>{{ $contact['last_name'] }} {{ $contact['first_name'] }}</td>
            </tr>
            <tr>
                <th>メール</th>
                <td>{{ $contact['email'] }}</td>
            </tr>
            <tr>
                <th>お問い合わせ種類</th>
                <td>{{ $category->content }}</td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>{{ $contact['tel'] }}</td>
            </tr>
            <tr>
                <th>住所</th>
                <td>{{ $contact['address'] }}</td>
            </tr>
            <tr>
                <th>建物名</th>
                <td>{{ $contact['building'] }}</td>
            </tr>
            <tr>
                <th>お問い合わせ内容</th>
                <td>{{ $contact['detail'] }}</td>
            </tr>
        </table>
    </div>

    <form action="/contacts" method="post">
        @csrf

        @foreach ($contact as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach

        <div class="confirm__button">
            <form action="/contacts" method="post" style="display:inline;">
                @csrf
                <button type="submit">送信</button>
            </form>

            <form action="/" method="get" style="display:inline;">
                @csrf
                <button type="submit">修正</button>
            </form>
        </div>
    </form>
</div>

@endsection