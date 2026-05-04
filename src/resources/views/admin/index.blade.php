@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')

<div class="admin__content">
    <div class="admin__heading">
        <h2>管理画面</h2>
    </div>

    <form class="search-form" action="/admin/search" method="get">

        <div class="search-form__item">
            <input type="text" name="keyword" value="{{ request('keyword') }}">
        </div>

        <div class="search-form__item">
            <select name="category_id">
                <option value=""></option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="search-form__item">
            <select name="gender">
                <option value=""></option>
                <option value="1" {{ request('gender') == 1 ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == 2 ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == 3 ? 'selected' : '' }}>その他</option>
            </select>
        </div>

        <div class="search-form__item">
            <input type="date" name="date" value="{{ request('date') }}">
        </div>

        <div class="search-form__button">
            <button class="search-form__button-submit">検索</button>
            <a href="/admin" class="search-form__button-reset">リセット</a>
        </div>

    </form>

    <table class="admin-table">
        <tr>
            <th>名前</th>
            <th>メール</th>
            <th>お問い合わせ種類</th>
            <th></th>
        </tr>

        @foreach ($contacts as $contact)
        <tr>
            <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->category->content ?? '' }}</td>
            <td>
                <form action="/admin/delete" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $contact->id }}">
                    <button class="admin-table__button admin-table__button--delete">
                        削除
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    <div class="pagination">
        {{ $contacts->links() }}
    </div>

</div>

@endsection