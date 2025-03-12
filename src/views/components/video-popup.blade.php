@if (isset($video))

    <?php
    $video_url = '#Video-invalide';
    if ($video->service == 'youtube') {
        $video_url = 'https://www.youtube.com/watch?v=' . $video->video_id;
    } elseif ($video->service == 'vimeo') {
        $video_url = 'https://vimeo.com/' . $video->video_id;
    }
    ?>

    <div class="video-container">
        <a class="video-thumbnail ratio-16x9" target="_blank" href="{{ $video_url }}" data-fancybox="videos">
            <img src="{{ Storage::disk('videos')->url($video->thumbnail_url) }}" alt="{{ $video->title }} (vidéo)">

            <div class="overlay">
                @svg('icon-play-video', 'play-video')
            </div>

        </a>
        @if (isset($video->title))
            <p class="video-legend">{{ $video->title }}</p>
        @endif
    </div>
@endif
