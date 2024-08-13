<div class="sub-navbar bg-body">
    <div class="container py-3">
        <div class="row gy-3 mx-md-5 align-items-center justify-content-center">
            <div class="col-md-4 d-flex align-items-center">
                <img src="{{ site_logo() }}" alt="{{ site_name() }}" height="100" class="position-relative z-5 h-80">
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
                    @auth
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
                        @include('elements.notifications')
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> {{ trans('auth.login') }}
                            </a>
                        </li>
                    @endauth
                    <a href="#" class="button">
                        Nu verkopen
                    </a>
                </ul>
            </div>
        </div>
    </div>
</div>
