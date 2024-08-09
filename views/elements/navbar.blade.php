<div class="home-background background-overlay" style="background: url('{{ setting('background') ? image_url(setting('background')) : 'https://via.placeholder.com/2000x500' }}') no-repeat center / cover">
    <div id="particles-js"></div>

    <nav class="navbar main-navbar navbar-expand-md navbar-dark py-3">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="{{ trans('messages.nav.toggle') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbar">
                <ul class="navbar-nav">
                    @foreach($navbar as $element)
                        @if(!$element->isDropdown())
                            <li class="nav-item">
                                <a class="nav-link @if($element->isCurrent()) active @endif" href="{{ $element->getLink() }}" @if($element->new_tab) target="_blank" rel="noopener noreferrer" @endif>
                                    {{ $element->name }}
                                </a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle @if($element->isCurrent()) active @endif" href="#" id="navbarDropdown{{ $element->id }}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $element->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown{{ $element->id }}">
                                    @foreach($element->elements as $childElement)
                                        <a class="dropdown-item @if($childElement->isCurrent()) active @endif" href="{{ $childElement->getLink() }}" @if($childElement->new_tab) target="_blank" rel="noopener noreferrer" @endif>
                                            {{ $childElement->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(Route::is('home'))
            <div class="row align-items-center justify-content-center">
                <div class="col-md-3 my-4">
                    <a class="col-md-6 text-center" href="{{ route('home') }}">
                        <img src="{{ site_logo() }}" alt="{{ site_name() }}" height="300" class="position-relative z-5">
                    </a>
                </div>
            </div>
        @endif

        <ul class="navbar-socials list-inline d-flex justify-content-center position-relative mb-0 pt-4 pb-5">
            @foreach(social_links() as $link)
                <li class="list-inline-item p-3 rounded">
                    <a href="{{ $link->value }}" target="_blank" rel="noreferrer noopener" title="{{ $link->title }}">
                        <i class="{{ $link->icon }} fs-2"></i>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="sub-navbar bg-body">
    <div class="container py-3">
        <div class="row gy-3 mx-md-5 align-items-center justify-content-center">
            <div class="col-md-4 d-flex align-items-center">
                <i class="bi bi-trophy text-primary fs-2 me-2"></i>
                @if($server && $server->isOnline())
                    {{ trans_choice('theme::guide.header.online', $server->getOnlinePlayers()) }}
                @else
                    {{ trans('theme::guide.header.offline') }}
                @endif
            </div>

            <div class="col-md-4 text-center">
                @if($server)
                    @if($server->joinUrl())
                        <a href="{{ $server->joinUrl() }}" class="btn btn-primary btn-lg px-4">
                            <i class="bi bi-controller"></i> {{ trans('messages.server.join') }}
                        </a>
                    @else
                        <button title="{{ trans('messages.actions.copy') }}" data-copied="{{ trans('messages.clipboard.copied') }}" data-copy-error="{{ trans('messages.clipboard.error') }}" class="btn btn-primary btn-lg px-4">
                            <i class="bi bi-controller"></i> {{ $server->fullAddress() }}
                        </button>
                    @endif
                @endif
            </div>

            <div class="col-md-4 navbar navbar-expand navbar-light">
                <ul class="navbar-nav ms-md-auto">
                    @include('elements.theme-selector')

                    @auth
                        @include('elements.notifications')

                        <li class="nav-item dropdown">
                            <a id="userDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile.index') }}">
                                    {{ trans('messages.nav.profile') }}
                                </a>

                                @if(Auth::user()->hasAdminAccess())
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        {{ trans('messages.nav.admin') }}
                                    </a>
                                @endif

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ trans('auth.logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> {{ trans('auth.login') }}
                            </a>
                        </li>

                        @if(Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">
                                    <i class="bi bi-person-plus-fill"></i> {{ trans('auth.register') }}
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</div>
