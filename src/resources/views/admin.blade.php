@extends('layouts.app', ['authgroup'=>'admin'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">管理者画面</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="mt-3">
                        <a href={{ route('admin_content.index') }} class='h5'>
                            学習コンテンツの管理へ
                        </a>
                    </div>
                    <div class="mt-3">
                        <a href={{ route('admin_language.index') }} class='h5'>
                            学習言語の管理へ
                        </a>
                    </div>

                </div>
            </div>
            <div>TO DO: ユーザー作成のUI</div>
            <div>
                <a href={{ route('admin-register') }} class='h5'>
                    管理者ユーザーの作成
                </a>
            </div>
                    
        </div>
    </div>
</div>
@endsection