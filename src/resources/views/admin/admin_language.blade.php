@extends('layouts.app', ['authgroup'=>'admin'])
@section('content')
    <div class="mx-auto text-center">
        {{-- 新規登録 --}}
        <section class="mb-3">
            <h2>新規登録</h2>
            <form action="{{ route('admin_language.store') }}" method="POST">
                @csrf
                <input type="text" name="name" value="{{ old('name') }}">
                <input type="text" name="color" value="{{ old('color') }}">
                <input type="submit" value="登録" class="btn btn-success">
            </form>
        </section>
        {{-- 編集 --}}
        <section class="d-inline-block w-50">
            <h2>登録済みの学習言語</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>言語名</th>
                        <th>言語色</th>
                        <th>編集</th>
                        <th>削除</th>
                    </tr>
                </thead>
                <tbody id="prefectureItems">
                    @foreach ($learning_languages as $learning_language)
                        <tr data-id="{{ $learning_language->id }}">
                            <td>
                                <div>
                                    <div class="font-weight-bold">{{ $learning_language->name }}</div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div class="font-weight-bold">{{ $learning_language->color }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('admin_language.edit', $learning_language->id) }}" class="btn btn-sm btn-primary">編集</a>
                            </td>
                            <td>
                                <form action="{{ route('admin_language.destroy', $learning_language->id) }}" method="POST">
                                {{-- <form action="" method="POST"> --}}
                                    @csrf
                                    <input type="submit" class="btn btn-sm btn-danger"
                                        onClick="return confirm('この学習言語を削除しますか？')" value="削除">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
@endsection