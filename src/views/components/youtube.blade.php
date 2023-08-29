@if (isset($youtubeThumbnailMedia) && isset($youtube))
    <div class="video-container">
        <a class="video-thumbnail ratio-16x9" target="_blank" href="https://www.youtube.com/watch?v={{ $youtube }}" data-fancybox="videos">
            {{ $youtubeThumbnailMedia }}

            <div class="overlay">
                @svg('icon-play-video', 'play-video')
            </div>

        </a>
        @if (isset($youtubeTitle))
            <p class="video-legend">{{ $youtubeTitle }}</p>
        @endif
    </div>
@endif
