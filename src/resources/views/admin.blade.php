@extends('layouts.app', ['authgroup'=>'admin'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">管理者 Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as 管理者!
                </div>
            </div>
            <div>TO DO: ユーザー作成のUI</div>
                    <div class="mt-3">
                        <a href={{ route('admin_content.index') }} class='h4'>
                            1. 学習コンテンツの管理へ
                        </a>
                    </div>
                    <div class="mt-3">
                        <a href={{ route('admin_language.index') }} class='h4'>
                            2. 学習言語の管理へ
                        </a>
                    </div>
        </div>
    </div>
</div>
@endsection