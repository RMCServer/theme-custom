@extends('layouts.base')

@section('app')
    <header>
        @include('elements.navbar')
    </header>

    <main class="container content home-container">
        @include('elements.session-alerts')
        <div class="border-container"></div>
        @yield('content')
    </main>
@endsection
<button onclick="topFunction()" id="myBtn" class="topbtn" style="display: none"><i class="bi bi-arrow-up"></i></button>
