@extends('layouts.app', ['authgroup'=>'admin'])
@section('content')
    <div class="mx-auto text-center">
        {{-- 新規登録 --}}
        <section class="mb-3">
            <!-- フラッシュメッセージ -->
            {{-- @if (session('success'))
                <div class="bg-success text-center py-3 my-0">
                    {{ session('success') }}
                </div>
            @endif --}}
             <!-- モーダルを開くボタン・リンク -->
    <div class="container">
        <div class="row my-3">
        </div>
        <div class="row mb-2">
            <div class="col-2">
                <button type="button" class="btn btn-primary mb-12" data-toggle="modal" data-target="#testModal">新規ユーザー登録</button>
            </div>
        </div>
    </div>
 
    <!-- ボタン・リンククリック後に表示される画面の内容 -->
    <div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 1000px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">新規ユーザー登録</h4>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header"> {{ __('Register') }}</div>
                    
                                    <div class="card-body">
                                         {{-- GPT --}}
                                            <form method="POST" action="{{ route('admin_users_table.store') }}">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                        
                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                    
                                                <div class="form-group row">
                                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                        
                                                    <div class="col-md-6">
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                    
                                                <div class="form-group row">
                                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                        
                                                    <div class="col-md-6">
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                    
                                                <div class="form-group row">
                                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                        
                                                    <div class="col-md-6">
                                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                    </div>
                                                </div>
                    
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6 offset-md-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Register') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                </div>
            </div>
        </div>
    </div>  
            
        </section>
        {{-- 編集 --}}
        <section class="d-inline-block w-50">
            <h2>登録済みの一般ユーザー</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ユーザー名</th>
                        <th>メールアドレス</th>
                        <th>編集</th>
                        <th>削除</th>
                        <th>復元</th>
                    </tr>
                </thead>
                <tbody id="prefectureItems">
                    @foreach ($users as $user)
                        <tr data-id="{{ $user->id }}">
                            <td>
                                <div>
                                    <div class="font-weight-bold">{{ $user->name }}</div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div class="font-weight-bold">{{ $user->email }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{-- <a href="{{ route('admin_users_table.edit', $user->id) }}" class="btn btn-sm btn-primary">編集</a> --}}
                            </td>
                            
                            <td>
                                {{-- <form action="{{ route('admin_users_tablet.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    <input type="submit" class="btn btn-sm btn-danger"
                                        onClick="return confirm('この学習コンテンツを削除しますか？')" value="削除">
                                </form> --}}
                            </td>
                            
                            
                                <td>
                                    {{-- <form action="{{ route('admin_users_table.restore', $user->id) }}" method="POST">
                                            @csrf
                                            <input type="submit" class="btn btn-sm btn-success"
                                                onClick="return confirm('この学習コンテンツを復元しますか？')" value="復元">
                                    </form> --}}
                                </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
@endsection
