@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin__alert">
    @if (session('message'))
    <div class="admin__alert--success">
        {{ session('message') }}
    </div>
    @endif
</div>
<div class="admin__content">
    <div class="admin__heading">
        <h2>Admin</h2>
    </div>
    <div class="search__content">
        <form action="/search" class="search-form" method="get">
            @csrf
            <input type="text" class="search-form__item-input keyword-input" name="keyword"
                placeholder="名前やメールアドレスを入力してください" />
            <select class="search-form__item-input" id="gender" name="gender">
                <option value="">性別　▼</option>
                @foreach (config('genders') as $index => $name)
                <option value=" {{ $index }}"> {{ $name }} </option>
                @endforeach
            </select>
            <select id="category_id" name="category_id" class="search-form__item-input">
                <option value="">お問い合わせの種類　▼</option>
                @foreach ($categories as $category)
                <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
                @endforeach
            </select>
            <input type="date" name="date" value="{{ old('created_at') }}" class="search-form__item-input"
                value="年/月/日　▼">
            <div class=" search-form__button">
                <button class="search-form__button-submit" type="submit">検索</button>
            </div>
            <a class="search-form__button-submit reset-button" href="/admin">リセット</a>
        </form>
    </div>
    <div class="page__content">
        <a href="/export" class="search-form__button-export">エキスポート</a>
        <div class="page__parts">
            {{ $contacts->links() }}
        </div>
    </div>
    <div class="admin__content-table">
        <table class="admin-table">
            <tr class="admin-table-row">
                <th class="last-name-cell">お名前</th>
                <th class="first-name-cell">　　　</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
            <?php
            $i = 0;
            ?>
            @foreach ($contacts as $contact)
            <?php
            $i++;
            ?>
            <tr class="admin-table-row">
                <td class="last-name-cell">{{$contact->last_name}}</td>
                <td class="first-name-cell">{{$contact->first_name}}</td>
                <td>
                    @if ($contact['gender'] == 1)
                    男性
                    @elseif ($contact['gender'] == 2)
                    女性
                    @elseif ($contact['gender'] == 3)
                    その他
                    @endif
                </td>
                <td>{{$contact->email}}</td>
                <td>
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
                <td>
                    <a class="modal-open-button" href="#modal<?= $i ?>">詳細</a>
                    <!-- <button type="button" class="modal-open-button" data-toggle="modal" data-target="#modal<?= $i ?>">
                        詳細
                    </button> -->
                    <div class="modal" id="modal<?= $i ?>">
                        <div class="modal-wrapper">
                            <a href="#" class="close">&times;</a>
                            <div class="modal-content">
                                <div class="modal-table">
                                    <table class="modal-table__inner">
                                        <tr class="modal-table__row">
                                            <th class="modal-table__header">お名前</th>
                                            <td class="modal-table__text">
                                                <div class="name-group">
                                                    {{ $contact['last_name'] }}　{{ $contact['first_name'] }}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="modal-table__row">
                                            <th class="modal-table__header">性別</th>
                                            <td class="modal-table__text">
                                                @if ($contact['gender'] == 1)
                                                男性
                                                @elseif ($contact['gender'] == 2)
                                                女性
                                                @elseif ($contact['gender'] == 3)
                                                その他
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="modal-table__row">
                                            <th class="modal-table__header">メールアドレス</th>
                                            <td class="modal-table__text">
                                                {{ $contact['email'] }}
                                            </td>
                                        </tr>
                                        <tr class="modal-table__row">
                                            <th class="modal-table__header">電話番号</th>
                                            <td class="modal-table__text">
                                                {{ $contact['tel'] }}
                                            </td>
                                        </tr>
                                        <tr class="modal-table__row">
                                            <th class="modal-table__header">住所</th>
                                            <td class="modal-table__text">
                                                {{ $contact['address'] }}
                                            </td>
                                        </tr>
                                        <tr class="modal-table__row">
                                            <th class="modal-table__header">建物名</th>
                                            <td class="modal-table__text">
                                                {{ $contact['building'] }}
                                            </td>
                                        </tr>
                                        <tr class="modal-table__row">
                                            <th class="modal-table__header">お問い合わせ種類</th>
                                            <td class="modal-table__text">
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
                                        <tr class="modal-table__row">
                                            <th class="modal-table__header">お問い合わせ内容</th>
                                            <td class="modal-table__text">
                                                {{ $contact['detail'] }}
                                        </tr>
                                    </table>
                                </div>
                                <form action="/delete" class="delete-form" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <div class=" form__button modal-delete">
                                        <input type="hidden" name="id" value="{{  $contact['id']  }}">
                                        <button class="form__button-submit" type="submit">削除</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection