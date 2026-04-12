@extends('layouts.app')

@section('content')
<div class="admin-content">
    <div class="admin-header">
        <h2>Admin</h2>
    </div>

    {{-- 検索フォームエリア --}}
    <div class="search-form">
        <form action="{{ route('admin.search') }}" method="GET" class="search-form__inner">
            <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">

            <select name="gender">
                <option value="">性別</option>
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

    {{-- ツールエリア（エクスポート・ページネーション） --}}
    <div class="admin-tools">
        <form action="{{ route('admin.export') }}" method="GET">
            <input type="hidden" name="keyword" value="{{ request('keyword') }}">
            <input type="hidden" name="gender" value="{{ request('gender') }}">
            <input type="hidden" name="category_id" value="{{ request('category_id') }}">
            <input type="hidden" name="date" value="{{ request('date') }}">
            <button type="submit" class="btn-export">エクスポート</button>
        </form>

        {{-- ページネーションのリンク --}}
        <div class="pagination-wrapper">
            {{ $contacts->links() }}
        </div>
    </div>

    {{-- 一覧テーブル --}}
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
            <tr>
                <td>{{ $contact->last_name }}　{{ $contact->first_name }}</td>
                <td>
                    @php
                        $genders = [1 => '男性', 2 => '女性', 3 => 'その他'];
                    @endphp
                    {{ $genders[$contact->gender] }}
                </td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->category->content }}</td>
                <td>
                    {{-- モーダル表示用ボタン --}}
                    <button class="btn-detail" onclick="showModal({{ $contact->id }})">詳細</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- 詳細モーダル（JavaScriptで表示を制御する想定） --}}
<div id="detail-modal" class="modal">
    <div class="modal-content">
        <button class="modal-close" onclick="closeModal()">&times;</button>
        <div id="modal-body">
            {{-- ここにJSでデータを流し込むか、各行ごとに隠しタグで持っておく --}}
        </div>
    </div>
</div>
@endsection
