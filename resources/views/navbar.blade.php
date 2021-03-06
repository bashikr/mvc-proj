<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom ">
    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ URL::asset('assets/images/todosmart.png') }}" class="icon" alt="todosmarticon">
    </a>
    @guest
    @else
        @if (request()->route()->uri == 'grid')
        @else
            <div class="pt-5">
                <p id="menu-toggle"><i class="fas fa-arrow-circle-right"></i></p>
            </div>
        @endif
    @endguest

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="float-right nav-item active ">
                    <a class="nav-link" href="{{ URL::to('/') }}">New <i class="fas fa-plus-circle"></i> <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
    </div>
    </li>
    </ul>
    </div>
</nav>
