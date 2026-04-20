@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-content">
    <div class="confirm-header">
        <h1>Confirm</h1>
    </div>

    <form action="{{ route('contacts.store') }}" method="POST">
        @csrf
        <div class="confirm-table-inner">
            <table class="confirm-table">
                <tr>
                    <th>お名前</th>
                    <td>
                        {{ $contact['first_name'] }}　{{ $contact['last_name'] }}
                        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                    </td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td>
                        @php
                            // tinyintをラベルに変換
                            $genders = [1 => '男性', 2 => '女性', 3 => 'その他'];
                        @endphp
                        {{ $genders[$contact['gender']] }}
                        <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                    </td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td>
                        {{ $contact['email'] }}
                        <input type="hidden" name="email" value="{{ $contact['email'] }}">
                    </td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td>
                        {{ $contact['tel1'] }}{{ $contact['tel2'] }}{{ $contact['tel3'] }}
                        <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
                        <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
                        <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
                    </td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td>
                        {{ $contact['address'] }}
                        <input type="hidden" name="address" value="{{ $contact['address'] }}">
                    </td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td>
                        {{ $contact['building'] ?? '' }}
                        <input type="hidden" name="building" value="{{ $contact['building'] }}">
                    </td>
                </tr>
                <tr>
                    <th>お問い合わせの種類</th>
                    <td>
                        {{ $category_content }}
                        <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                    </td>
                </tr>
                <tr>
                    <th>お問い合わせ内容</th>
                    <td>
                        {{ $contact['detail'] }}
                        <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
                    </td>
                </tr>
            </table>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">送信</button>
            <button type="submit" name="back" value="true" class="btn-fix">修正</button>
        </div>
    </form>
</div>
@endsection
