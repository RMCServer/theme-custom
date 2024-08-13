@extends('layouts.app')

@section('title', trans('messages.home'))

@section('content')
<div class="background-vors home"></div>
    <div class="container">
        <div class="home-top">
            @if($message)
                <div class="card mb-5">
                    <div class="card-body text-center">
                        {{ $message }}
                    </div>
                </div>
            @endif

            <div class="text-content"><div class="content"><div class="title-wrap"><h6 class="title-prefix">Onze services</h6><h1 class="title">Boteninkoop service in hartje amsterdam</h1></div><div class="separator"></div><p class="desc">orem ipsum dolor sit amet, consectetur adipiscing elit. Cras lobortis odio et eros scelerisque, sit amet volutpat mauris aliquet. Morbi maximus, diam viverra tincidunt tristique, leo elit aliquet nunc, nec auctor elit dolor eget tellus. In velit tortor, imperdiet vel vulputate eget, congue at lectus. Praesent scelerisque, velit eget aliquet luctus, turpis leo finibus turpis, non malesuada erat.</p></div></div>
            <a href="#" class="button">
               <i class="bi bi-calendar2-check-fill mr-10"></i>
               <span>Maak nu een afspraak</span>
            </a>
        </div>

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
