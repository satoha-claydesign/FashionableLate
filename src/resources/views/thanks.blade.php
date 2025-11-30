@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks__content">
    <div class="thanks__heading">
        <div class="background-text">お問い合わせありがとうございました
        </div>
        <div class="thanks__group">
            <a class="home__button" href="/">HOME</a>
        </div>
    </div>
</div>
@endsection