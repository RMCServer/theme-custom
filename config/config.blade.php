@extends('admin.layouts.admin')

@section('title', 'Theme config')

@include('admin.elements.color-picker')

@push('footer-scripts')
    <script>
        function addLinkListener(el) {
            el.addEventListener('click', function () {
                const element = el.parentNode.parentNode.parentNode;

                element.parentNode.removeChild(element);
            });
        }

        document.querySelectorAll('.link-remove').forEach(function (el) {
            addLinkListener(el);
        });

        document.getElementById('addLinkButton').addEventListener('click', function () {
            let input = '<div class="row g-3"><div class="mb-3 col-md-6">';
            input += '<input type="text" class="form-control" name="footer_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}"></div>';
            input += '<div class="mb-3 col-md-6"><div class="input-group">';
            input += '<input type="url" class="form-control" name="footer_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}">';
            input += '<button class="btn btn-outline-danger link-remove" type="button">';
            input += '<i class="bi bi-x-lg"></i></button></div></div></div>';

            const newElement = document.createElement('div');
            newElement.innerHTML = input;

            addLinkListener(newElement.querySelector('.link-remove'));

            document.getElementById('links').appendChild(newElement);
        });

        document.getElementById('configForm').addEventListener('submit', function () {
            let i = 0;

            document.getElementById('links').querySelectorAll('.row').forEach(function (el) {
                el.querySelectorAll('input').forEach(function (input) {
                    input.name = input.name.replace('{index}', i.toString());
                });

                i++;
            });
        });
    </script>
@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.themes.config', $theme) }}" method="POST" id="configForm">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="colorInput">{{ trans('messages.fields.color') }}</label>
                    <input type="color" class="form-control form-control-color color-picker @error('color') is-invalid @enderror" id="colorInput" name="color" value="{{ old('color', theme_config('color', '#c0392b')) }}" required>

                    @error('color')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="youtube">{{ trans('theme::guide.config.youtube') }}</label>
                            <input type="text" class="form-control @error('youtube_link') is-invalid @enderror" id="youtube" name="youtube_link" value="{{ old('youtube_link', theme_config('youtube_link')) }}">

                            @error('youtube_link')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="discordId">{{ trans('theme::guide.config.discord') }}</label>
                            <input type="text" class="form-control @error('discord_id') is-invalid @enderror" id="discordId" name="discord_id" value="{{ old('discord_id', theme_config('discord_id')) }}">
                            <small class="form-text">{{ trans('theme::guide.config.discord_info') }}</small>

                            @error('discord_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="twitterName">{{ trans('theme::guide.config.twitter') }}</label>
                            <input type="url" class="form-control @error('twitter') is-invalid @enderror" id="twitterName" name="twitter" value="{{ old('twitter', theme_config('twitter')) }}">

                            @error('twitter')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>

                <h3>Footer</h3>

                <div class="mb-3">
                    <label class="form-label" for="footerDescriptionInput">{{ trans('theme::guide.config.footer_description') }}</label>
                    <textarea class="form-control @error('footer_description') is-invalid @enderror" id="footerDescriptionInput" name="footer_description" rows="3">{{ old('footer_description', theme_config('footer_description')) }}</textarea>

                    @error('footer_description')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="footerArticleInput">{{ trans('theme::guide.config.footer_article') }}</label>
                    <textarea class="form-control @error('footer_article') is-invalid @enderror" id="footerArticleInput" name="footer_article" rows="2">{{ old('footer_article', theme_config('footer_article')) }}</textarea>

                    @error('footer_article')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <label class="form-label">{{ trans('theme::guide.config.footer_links') }}</label>

                <div id="links">
                    @foreach(theme_config('footer_links') ?? [] as $link)
                        <div class="row g-3">
                            <div class="mb-3 col-md-6">
                                <input type="text" class="form-control" name="footer_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}" value="{{ $link['name'] }}">
                            </div>

                            <div class="mb-3 col-md-6">
                                <div class="input-group">
                                    <input type="url" class="form-control" name="footer_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}" value="{{ $link['value'] }}">
                                    <button class="btn btn-outline-danger link-remove" type="button">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mb-3">
                    <button type="button" id="addLinkButton" class="btn btn-sm btn-success">
                        <i class="bi bi-plus-lg"></i> {{ trans('messages.actions.add') }}
                    </button>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> {{ trans('messages.actions.save') }}
                </button>
            </form>
        </div>
    </div>
@endsection
