<?php

return [
    'color' => ['required', new \Azuriom\Rules\Color()],
    'use_play_button' => ['filled'],
    'youtube_link' => 'nullable|string',
    'discord_id' => 'nullable|string',
    'twitter' => 'nullable|string',
    'footer_description' => 'required|string',
    'footer_article' => 'required|string',
    'footer_links' => 'nullable|array',
    'footer_social_twitter' => 'nullable|string',
    'footer_social_discord' => 'nullable|string',
    'footer_social_steam' => 'nullable|string',
    'footer_social_youtube' => 'nullable|string',
    'footer_social_teamspeak' => 'nullable|string',
    'footer_social_instagram' => 'nullable|string',
    'footer_social_twitch' => 'nullable|string',
    'footer_social_facebook' => 'nullable|string',
];
