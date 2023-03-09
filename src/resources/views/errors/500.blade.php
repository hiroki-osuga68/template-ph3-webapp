@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">エラー</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>ご不便をおかけして申し訳ございません。</p>
                    {{-- 本番環境では下記は消去 --}}
                    <p>{{ $exception->getMessage() }}</p>
                    <p>ステータスコード{{ $exception->getStatusCode() }}</p>
                    <p class="lead">
                    <a class="btn btn-primary" href="{{ route('webapp') }}" role="button">トップページへ戻る</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection