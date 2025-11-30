@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm__content">
    <div class="confirm__heading">
        <h2>Confirm</h2>
    </div>
    <form class="form" action="/thanks" method="post">
        @csrf
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        <div class="name-group">
                            <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}" readonly />
                            <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}" readonly />
                            {{ $contact['last_name'] }}　{{ $contact['first_name'] }}
                        </div>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        <input type="hidden" name="gender" value="{{ $contact['gender'] }}" readonly />
                        @if ($contact['gender'] == 1)
                        男性
                        @elseif ($contact['gender'] == 2)
                        女性
                        @elseif ($contact['gender'] == 3)
                        その他
                        @endif
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        <input type="email" name="email" value="{{ $contact['email'] }}" />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        <span>
                            <input type="tel" name="tel"
                                value=" {{ $contact['tel01'].$contact['tel02'].$contact['tel03'] }}" readonly />
                            <input type="hidden" name="tel01" value="{{ $contact['tel01'] }}">
                            <input type="hidden" name="tel02" value="{{ $contact['tel02'] }}">
                            <input type="hidden" name="tel03" value="{{ $contact['tel03'] }}">
                        </span>
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        <input type="text" name="address" value="{{ $contact['address'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        <input type="text" name="building" value="{{ $contact['building'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ種類</th>
                    <td class="confirm-table__text">
                        <input type="hidden" id="id" name="category_id" value="{{ $contact['category_id'] }}"
                            readonly />
                        @if ($contact['category_id'] == 1)
                        1. 商品のお届けについて
                        @elseif ($contact['category_id'] == 2)
                        2. 商品の交換について
                        @elseif ($contact['category_id'] == 3)
                        3. 商品トラブル
                        @elseif ($contact['category_id'] == 4)
                        4. ショップへのお問い合わせ
                        @elseif ($contact['category_id'] == 5)
                        5. その他
                        @endif
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__text">
                        <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly />
                </tr>
            </table>
        </div>
        <div class="button-group">
            <div class="form__button">
                <button class="form__button-submit" type="submit">送信</button>
            </div>
            <div class="form__button">
                <button class="form__button-correct" type="submit" name="back" value="back">修正</button>
            </div>
        </div>
    </form>
</div>
@endsection