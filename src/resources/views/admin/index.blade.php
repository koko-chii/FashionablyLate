@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('js')
<script src="{{ asset('js/admin.js') }}" defer></script>
@endsection

@section('header-nav')
<nav>
    <form action="/logout" method="post">
        @csrf
        <button class="header-nav__button">logout</button>
    </form>
</nav>
@endsection

@section('content')
<div class="admin-content">
    <div class="admin-header">
        <h1>Admin</h1>
    </div>

    {{-- 検索フォームエリア --}}
    <div class="search-form">
        <form action="{{ route('admin.search') }}" method="GET" class="search-form__inner">
            <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">

            <select name="gender">
                <option value="" {{ request('gender') == '' ? 'selected' : '' }}>性別</option>
                <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>全て</option>
                <option value="1" {{ request('gender') == 1 ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == 2 ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == 3 ? 'selected' : '' }}>その他</option>
            </select>

            <select name="category_id">
                <option value="">お問い合わせの種類</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>

            <input type="date" name="date" value="{{ request('date') }}">

            <button type="submit" class="btn-search">検索</button>
            <a href="{{ route('admin.index') }}" class="btn-reset">リセット</a>
        </form>
    </div>

    {{-- ツールエリア --}}
    <div class="admin-tools">
        <form action="{{ route('admin.export') }}" method="GET">
            <input type="hidden" name="keyword" value="{{ request('keyword') }}">
            <input type="hidden" name="gender" value="{{ request('gender') }}">
            <input type="hidden" name="category_id" value="{{ request('category_id') }}">
            <input type="hidden" name="date" value="{{ request('date') }}">
            <button type="submit" class="btn-export">エクスポート</button>
        </form>

        <div class="pagination-wrapper">
            {{ $contacts->links() }}
        </div>
    </div>

    {{-- 一覧テーブル --}}
    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                @php $genders = [1 => '男性', 2 => '女性', 3 => 'その他']; @endphp
                <tr>
                    <td>{{ $contact->first_name }}　{{ $contact->last_name }}</td>
                    <td>{{ $genders[$contact->gender] }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->category->content }}</td>
                    <td>

                        <button class="btn-detail js-modal-open"
                            data-first-name="{{ $contact->first_name }}"
                            data-last-name="{{ $contact->last_name }}"
                            data-gender="{{ $genders[$contact->gender] }}"
                            data-email="{{ $contact->email }}"
                            data-tel="{{ str_replace('-', '', $contact->tel) }}"
                            data-address="{{ $contact->address }}"
                            data-building="{{ $contact->building }}"
                            data-category="{{ $contact->category->content }}"
                            data-detail="{{ $contact->detail }}"
                            data-id="{{ $contact->id }}">
                            詳細
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- 詳細モーダル（ループの外側に1つだけ配置） --}}
<div id="detail-modal" class="modal">
    <div class="modal-content">
        <div class="modal-close-wrapper">
            <button class="modal-close js-modal-close">&times;</button>
        </div>

        <div id="modal-body">
            {{-- JSから値を受け取るための空のテーブル --}}
            <table class="modal-inner-table">
                <tr><th>お名前</th><td id="mdl-name"></td></tr>
                <tr><th>性別</th><td id="mdl-gender"></td></tr>
                <tr><th>メールアドレス</th><td id="mdl-email"></td></tr>
                <tr><th>電話番号</th><td id="mdl-tel"></td></tr>
                <tr><th>住所</th><td id="mdl-address"></td></tr>
                <tr><th>建物名</th><td id="mdl-building"></td></tr>
                <tr><th>お問い合わせの種類</th><td id="mdl-category"></td></tr>
                <tr><th>お問い合わせ内容</th><td id="mdl-detail"></td></tr>
            </table>
        </div>

        {{-- 削除ボタン --}}
        <form action="{{ route('admin.delete') }}" method="POST" class="delete-form">
            @csrf
            <input type="hidden" name="id" id="modal-delete-id" value="">
            <button type="submit" class="btn-delete-submit" onclick="return confirm('本当に削除しますか？')">削除</button>
        </form>
    </div>
</div>
@endsection
