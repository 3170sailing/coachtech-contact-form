@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>

    <form class="form" action="/confirm" method="post" novalidate>
        @csrf

        <div class="form__group">
            <div class="form__label">
                お名前 <span>※</span>
            </div>
            <div class="form__input--name">
                <div>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例：山田">
                    @error('last_name')
                        <p class="form__error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例：太郎">
                    @error('first_name')
                        <p class="form__error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__label">
                性別 <span>※</span>
            </div>

            <div class="form__input">
                <div class="form__input--radio">
                    <label><input type="radio" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}> 男性</label>
                    <label><input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> 女性</label>
                    <label><input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> その他</label>
                </div>

                @error('gender')
                    <p class="form__error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form__group">
            <div class="form__label">
                メールアドレス <span>※</span>
            </div>
            <div class="form__input">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="例：test@example.com">
                @error('email')
                    <p class="form__error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form__group">
            <div class="form__label">
                電話番号 <span>※</span>
            </div>
            <div class="form__input--tel">
                <div>
                    <input type="text" name="tel1" value="{{ old('tel1') }}" placeholder="080">
                    @error('tel1')
                        <p class="form__error-message">{{ $message }}</p>
                    @enderror
                </div>

                <span>-</span>

                <div>
                    <input type="text" name="tel2" value="{{ old('tel2') }}" placeholder="1234">
                    @error('tel2')
                        <p class="form__error-message">{{ $message }}</p>
                    @enderror
                </div>

                <span>-</span>

                <div>
                    <input type="text" name="tel3" value="{{ old('tel3') }}" placeholder="5678">
                    @error('tel3')
                        <p class="form__error-message">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__group">
            <div class="form__label">
                住所 <span>※</span>
            </div>
            <div class="form__input">
                <input type="text" name="address" value="{{ old('address') }}" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3">
                @error('address')
                    <p class="form__error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form__group">
            <div class="form__label">
                建物名
            </div>
            <div class="form__input">
                <input type="text" name="building" value="{{ old('building') }}" placeholder="例：千駄ヶ谷マンション101">
            </div>
        </div>

        <div class="form__group">
            <div class="form__label">
                お問い合わせの種類 <span>※</span>
            </div>
            <div class="form__input form__input--select">
                <select name="category_id">
                    <option value="">選択してください</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="form__error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form__group">
            <div class="form__label">
                お問い合わせ内容 <span>※</span>
            </div>
            <div class="form__input">
                <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                @error('detail')
                    <p class="form__error-message">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection