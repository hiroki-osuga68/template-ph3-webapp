@extends('layouts.app', ['authgroup'=>'admin'])
@section('content')
    <div class="mx-auto text-center">
        {{-- 新規登録 --}}
        <section class="mb-3">
            <h2>新規登録</h2>
            <form action="{{ route('admin_content.store') }}" method="POST">
                @csrf
                <input type="text" name="name" value="{{ old('name') }}">
                <input type="text" name="color" value="{{ old('color') }}">
                <input type="submit" value="登録" class="btn btn-success">
            </form>
        </section>
        {{-- 編集 --}}
        <section class="d-inline-block w-50">
            <h2>登録済みの学習コンテンツ</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>コンテンツ名</th>
                        <th>コンテンツ色</th>
                        <th>編集</th>
                        <th>削除</th>
                        <th>復元</th>
                    </tr>
                </thead>
                <tbody id="prefectureItems">
                    @foreach ($learning_contents as $learning_content)
                        <tr data-id="{{ $learning_content->id }}">
                            <td>
                                <div>
                                    <div class="font-weight-bold">{{ $learning_content->name }}</div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div class="font-weight-bold">{{ $learning_content->color }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('admin_content.edit', $learning_content->id) }}" class="btn btn-sm btn-primary">編集</a>
                            </td>
                            @if(isset($learning_content->deleted_at))
                            <td></td>
                            @else
                            <td>
                                <form action="{{ route('admin_content.destroy', $learning_content->id) }}" method="POST">
                                    @csrf
                                    <input type="submit" class="btn btn-sm btn-danger"
                                        onClick="return confirm('この学習コンテンツを削除しますか？')" value="削除">
                                </form>
                            </td>
                            @endif
                            @if(isset($learning_content->deleted_at))
                                <td>
                                    <form action="{{ route('admin_content.restore', $learning_content->id) }}" method="POST">
                                            @csrf
                                            <input type="submit" class="btn btn-sm btn-success"
                                                onClick="return confirm('この学習コンテンツを復元しますか？')" value="復元">
                                    </form>
                                </td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
@endsection
