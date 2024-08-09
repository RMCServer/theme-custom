@extends('layouts.app')

@section('title', trans('messages.home'))

@section('content')
    <div class="container">
        @if($message)
            <div class="card mb-5">
                <div class="card-body text-center">
                    {{ $message }}
                </div>
            </div>
        @endif

        @if(theme_config('youtube_link'))
            <div class="ratio ratio-16x9 mb-4">
                <iframe src="https://www.youtube.com/embed/{{ theme_config('youtube_link') }}&autoplay=1"
                        srcdoc="<style>*{padding:0;margin:0;overflow:hidden}html,body{height:100%}img,span{position:absolute;width:100%;top:0;bottom:0;margin:auto}span{height:1.5em;text-align:center;font:48px/1.5 sans-serif;color:white;text-shadow:0 0 0.5em black}</style><a href=https://www.youtube.com/embed/{{ theme_config('youtube_link') }}?autoplay=1><img src=https://img.youtube.com/vi/{{ theme_config('youtube_link') }}/hqdefault.jpg><span>▶</span></a>"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                ></iframe>
            </div>
        @endif

        @if(! $servers->isEmpty())
            <h2 class="text-center">{{ trans('messages.servers') }}</h2>

            <div class="row gy-3 justify-content-center mb-5">
                @foreach($servers as $server)
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <h3 class="card-title">
                                    {{ $server->name }}
                                </h3>

                                @if($server->isOnline())
                                    <div class="progress mb-1">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $server->getPlayersPercents() }}%">
                                        </div>
                                    </div>

                                    <p class="mb-1">
                                        {{ trans_choice('messages.server.total', $server->getOnlinePlayers(), [
                                            'max' => $server->getMaxPlayers(),
                                        ]) }}
                                    </p>
                                @else
                                    <p>
                                    <span class="badge bg-danger text-white">
                                        {{ trans('messages.server.offline') }}
                                    </span>
                                    </p>
                                @endif

                                @if($server->joinUrl())
                                    <a href="{{ $server->joinUrl() }}" class="btn btn-primary">
                                        {{ trans('messages.server.join') }}
                                    </a>
                                @else
                                    <p class="card-text">{{ $server->fullAddress() }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="row gy-4">
            <div class="col-md-8">
                @foreach($posts as $post)
                    <div class="card mb-4">
                        @if($post->hasImage())
                            <a href="{{ route('posts.show', $post->slug) }}">
                                <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="card-img-top">

                                <div class="card-body">
                                    <h3 class="card-title">{{ $post->title }}</h3>
                                    <h4 class="card-subtitle mb-3">
                                        {{ format_date($post->published_at) }}
                                    </h4>

                                    <a class="btn btn-primary" href="{{ route('posts.show', $post->slug) }}">
                                        {{ trans('messages.posts.read') }} <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </a>
                        @else
                            <div class="card-body">
                                <h3 class="card-title">{{ $post->title }}</h3>
                                <h4 class="card-subtitle">
                                    {{ format_date($post->published_at) }}
                                </h4>

                                <hr>

                                <p class="card-text">
                                    {{ Str::limit(strip_tags($post->content), 400) }}
                                </p>
                                <a class="btn btn-primary" href="{{ route('posts.show', $post->slug) }}">
                                    {{ trans('messages.posts.read') }} <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="col-md-4">
                <!-- Discord -->
                @if(theme_config('discord_id'))
                    <iframe class="discord mb-3" src="https://discordapp.com/widget?id={{  theme_config('discord_id') }}&theme=dark"></iframe>
                @endif

                <!-- Twitter -->
                @if(theme_config('twitter'))
                    <a class="twitter-timeline" href="{{ theme_config('twitter') }}" data-widget-id="408255561281462272" style="text-decoration: none; transition: .3s;">Twitter</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                @endif
            </div>
        </div>
    </div>
@endsection
