@section('header')
    <!-- ヘッダー部分 -->
    <header id="header">
        <div id="header_inner" class="wrapper">
            <div class="logo_area">
                <h1 class="site_title">
                    <img src="https://posse-ap.com/img/posseLogo.png" alt="POSSE">
                </h1>
                <span class="week">{{ $week_of_year }}th week</span>
            </div>
            {{-- ユーザーネームとログアウト処理 --}}
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown user">
                    <a id="navbarDropdown" class="nav-link p-0 dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            <button id="openModal" class="submit__button">記録・投稿</button>
        </div>
    </header>
@endsection
