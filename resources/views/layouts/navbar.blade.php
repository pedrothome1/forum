<nav class="navbar navbar-expand-md navbar-light custom-navbar py-lg-2">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fa fa-comments-o fa-lg"></i> {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @auth
                    <li>
                        <a class="btn btn-success btn-bright-success ml-md-3 my-2 my-md-0" href="/threads/create">
                            Novo tópico
                        </a>
                    </li>
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li>
                        <a class="nav-link d-none d-md-inline-block" @click.prevent="$modal.show('login')" href="#">
                            Entrar
                        </a>

                        <a class="nav-link d-md-none" href="{{ route('login') }}">
                            Entrar
                        </a>
                    </li>

                    <li>
                        <a class="nav-link d-none d-md-inline-block" @click.prevent="$modal.show('register')" href="#">
                            Cadastrar-se
                        </a>

                        <a class="nav-link d-md-none" href="{{ route('register') }}">
                            Cadastrar-se
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->username }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if (auth()->user()->isAdmin())
                                <a class="dropdown-item" href="#">
                                    <i class="fa fa-tachometer fa-fw text-muted"></i> Painel
                                </a>
                            @endif

                            <a class="dropdown-item" href="{{ route('profile', Auth::user()->username) }}">
                                <i class="fa fa-user fa-fw text-muted"></i> Meu perfil
                            </a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out fa-fw text-muted"></i> Sair
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
