<footer class="text-bg-dark py-5" data-bs-theme="dark">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h3>{{ trans('theme::guide.footer.about') }}</h3>

                <p>{!! theme_config('footer_description') !!}</p>
            </div>
            <div class="col-md-4">
                <h3>{{ trans('theme::guide.footer.links') }}</h3>

                <p>{!! theme_config('footer_article') !!}</p>

                <ul class="list-inline">
                    @foreach(theme_config('footer_links') ?? [] as $link)
                        <li class="list-inline-item">
                            <a href="{{ $link['value'] }}">
                                <i class="bi bi-arrow-right"></i> {{ $link['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-4">
                <h3>{{ trans('theme::guide.footer.social') }}</h3>

                <div class="list-inline">
                    @foreach(social_links() as $link)
                        <a href="{{ $link->value }}" title="{{ $link->title }}" class="list-inline-item me-3" data-bs-toggle="tooltip" target="_blank" rel="noopener noreferrer">
                            <i class="{{ $link->icon }} fs-2"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-6">
                <p class="mb-0">{{ setting('copyright') }}</p>
            </div>
            <div class="col-md-6">
                <p class="mb-0 text-end">@lang('messages.copyright')</p>
            </div>
        </div>
    </div>
</footer>
