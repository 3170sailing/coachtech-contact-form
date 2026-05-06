@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin__content">

    <div class="admin__heading">
        <h2>Admin</h2>
    </div>

    <form class="search-form" action="{{ url('/admin/search') }}" method="get">
        <div class="search-form__row">

            <input class="search-form__keyword" type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">

            <div class="search-form__item search-form__select">
                <select class="search-form__gender" name="gender">
                    <option value="">性別</option>
                    <option value="1" @if(request('gender') == '1') selected @endif>男性</option>
                    <option value="2" @if(request('gender') == '2') selected @endif>女性</option>
                    <option value="3" @if(request('gender') == '3') selected @endif>その他</option>
                </select>
            </div>

            <div class="search-form__item search-form__select">
                <select class="search-form__category" name="category_id">
                    <option value="">お問い合わせの種類</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(request('category_id') == $category->id) selected @endif>
                            {{ $category->content }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="search-form__item search-form__date">
                <input type="date" id="dateInput" name="date" value="{{ request('date') }}">
            </div>

            <button class="search-form__button-submit">検索</button>
            <a href="{{ url('/admin') }}" class="search-form__button-reset">リセット</a>

        </div>
    </form>

    <div class="admin__sub">
        <a href="{{ url('/export?' . http_build_query(request()->query())) }}" class="admin__export">
            エクスポート
        </a>

        <div class="pagination">

            @if ($contacts->onFirstPage())
                <span class="pagination__item">&lt;</span>
            @else
                <a class="pagination__item" href="{{ $contacts->previousPageUrl() }}">&lt;</a>
            @endif

            @php
                $last = $contacts->lastPage();
                $end = min($last, 5);
            @endphp

            @for ($i = 1; $i <= $end; $i++)
                @if ($i == $contacts->currentPage())
                    <span class="pagination__item pagination__item--active">{{ $i }}</span>
                @else
                    <a class="pagination__item" href="{{ $contacts->url($i) }}">{{ $i }}</a>
                @endif
            @endfor

            @if ($contacts->hasMorePages())
                <a class="pagination__item" href="{{ $contacts->nextPageUrl() }}">&gt;</a>
            @else
                <span class="pagination__item">&gt;</span>
            @endif

        </div>
    </div>

    <table class="admin-table">
        <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th></th>
        </tr>

        @foreach ($contacts as $contact)
        <tr>
            <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
            <td>
                @if($contact->gender == 1) 男性
                @elseif($contact->gender == 2) 女性
                @else その他
                @endif
            </td>
            <td>{{ $contact->email }}</td>
            <td>{{ optional($contact->category)->content }}</td>
            <td>
                <label class="admin-table__button" for="modal-{{ $contact->id }}">詳細</label>

                <input type="checkbox" id="modal-{{ $contact->id }}" class="modal-toggle">

                    <div class="modal">
                        <div class="modal__content">
                            <label class="modal__close" for="modal-{{ $contact->id }}">×</label>

                            <table class="modal-table">
                                <tr>
                                    <th>お名前</th>
                                    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                                </tr>
                                <tr>
                                    <th>性別</th>
                                    <td>
                                        @if($contact->gender == 1) 男性
                                        @elseif($contact->gender == 2) 女性
                                        @else その他
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>メールアドレス</th>
                                    <td>{{ $contact->email }}</td>
                                </tr>
                                <tr>
                                    <th>電話番号</th>
                                    <td>{{ $contact->tel }}</td>
                                </tr>
                                <tr>
                                    <th>住所</th>
                                    <td>{{ $contact->address }}</td>
                                </tr>
                                <tr>
                                    <th>建物名</th>
                                    <td>{{ $contact->building }}</td>
                                </tr>
                                <tr>
                                    <th>お問い合わせの種類</th>
                                    <td>{{ optional($contact->category)->content }}</td>
                                </tr>
                                <tr>
                                    <th>お問い合わせ内容</th>
                                    <td>{{ $contact->detail }}</td>
                                </tr>
                            </table>

                            <form action="/admin/delete" method="post" class="modal__delete-form">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $contact->id }}">
                                <button class="modal__delete-button">削除</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('dateInput');
    dateInput.addEventListener('click', function() {
        if (dateInput.showPicker) {
            dateInput.showPicker();
        }
    });
});
</script>

@endsection