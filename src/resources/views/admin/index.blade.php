@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
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
                        {{-- 修正ポイント：showModalに this を渡すように変更 --}}
                        <button class="btn-detail" onclick="showModal(this)">詳細</button>

                        {{-- 【重要】隠しデータエリア：この行のデータをモーダルに表示させるための箱 --}}
                        <div class="contact-data" style="display: none;">
                            <table class="modal-inner-table">
                                <tr><th>お名前</th><td>{{ $contact->first_name }}　{{ $contact->last_name }}</td></tr>
                                <tr><th>性別</th><td>{{ $genders[$contact->gender] }}</td></tr>
                                <tr><th>メールアドレス</th><td>{{ $contact->email }}</td></tr>
                                <tr><th>電話番号</th><td>{{ str_replace('-', '', $contact->tel) }}</td></tr>
                                <tr><th>住所</th><td>{{ $contact->address }}</td></tr>
                                <tr><th>建物名</th><td>{{ $contact->building }}</td></tr>
                                <tr><th>お問い合わせの種類</th><td>{{ $contact->category->content }}</td></tr>
                                <tr><th>お問い合わせ内容</th><td>{{ $contact->detail }}</td></tr>
                            </table>
                            {{-- 削除ボタン --}}
                            <form action="{{ route('admin.delete') }}" method="POST" class="delete-form">
                                @csrf
                                <input type="hidden" name="id" value="{{ $contact->id }}">
                                <button type="submit" class="btn-delete-submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- 詳細モーダル --}}
<div id="detail-modal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-close-wrapper">
            <button class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <div id="modal-body">
            {{-- ここにJSでデータが流し込まれます --}}
        </div>
    </div>
</div>

{{-- 動きをつけるためのJavaScript --}}
<script>
function showModal(btn) {
    // ボタンのすぐ隣にある「contact-data」クラスのHTMLを取得
    const data = btn.nextElementSibling.innerHTML;
    // モーダルの body 部分にそのHTMLをコピーする
    document.getElementById('modal-body').innerHTML = data;
    // モーダルを表示する（CSSで設定した .modal に合わせる）
    document.getElementById('detail-modal').style.display = 'flex';
}

function closeModal() {
    // モーダルを非表示にする
    document.getElementById('detail-modal').style.display = 'none';
}

</script>
@endsection
