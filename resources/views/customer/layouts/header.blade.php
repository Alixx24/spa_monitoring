@include('panel.layouts.head-tag')


<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
    <div class="container-fluid custom-margin-left">
        <a class="navbar-brand" href="{{ route('home.index') }}">Home</a>
        <div class="d-block d-md-none ml-mbobile-sign ">

            @auth


                <form action="{{ route('logout.post') }}" method="POST" class="d-inline">
                    @csrf

                    <a href="{{ route('dashboard.index', auth()->user()->id) }}" class="btn d-inline  ms-2 ml-mobile"> <i
                            class="bi bi-gear-wide-connected fs-1 text-success p-1"></i>
                    </a>

                </form>
            @endauth

            @if (auth()->guest())
                <form class="d-flex">


                    <button type="button" data-bs-toggle="modal" data-bs-target="#loginMobileModal"
                        class="btn border-0 p-0">
                        <i class="fs-1 bi bi-person"></i>
                    </button>

                </form>
            @endif
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>



        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Platform</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Viewer
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Fake views on Telegram</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Platform
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Enterprise</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.document.index') }}" tabindex="-1"
                        aria-disabled="true">Documention</a>
                </li>

            </ul>
            <div class="d-none d-md-block">
                @auth
                    {{ auth()->user()->email }}

                    <form action="{{ route('logout.post') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger ms-2">
                            Log out
                        </button>
                        <a href="{{ route('dashboard.index', auth()->user()->id) }}"
                            class="btn d-inline btn-outline-success ms-2">Dashboard</a>

                    </form>
                @endauth

                @if (auth()->guest())
                    <form class="d-flex">
                        <button type="button" class="btn btn-outline-success me-2" data-bs-toggle="modal"
                            data-bs-target="#loginModal">
                            Login
                        </button>


                        <a class="btn btn-outline-primary me-2" type="submit" data-bs-toggle="modal"
                            data-bs-target="#registerModal">Sign up</a>
                    </form>
                @endif
            </div>

        </div>
    </div>
</nav>



<x-login-modal />
<x-register-modal />

{{-- mobile --}}
<x-register-mobile-modal />
