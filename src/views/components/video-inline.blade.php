@if (isset($video))
    <div class="video-thumbnail ratio-16x9">

        {{-- Youtube --}}
        @if ($video->service == 'youtube')
            <iframe src="https://www.youtube-nocookie.com/embed/{{ $video->video_id }}?&loop=1&playlist={{ $video->video_id }}&rel=0&controls=1&autoplay=1&mute=1&start=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
        @elseif($video->service == 'vimeo')
            {{-- Version avec background (pas de possibilité de unmute) --}}
            {{-- <iframe src="https://player.vimeo.com/video/{{ $video->video_id }}?background=1" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe> --}}

            {{-- Version avec controles (possibilité de unmute) --}}
            <iframe src="https://player.vimeo.com/video/{{ $video->video_id }}?loop=1&autoplay=1&muted=1&title=0&byline=0&controls=1&dnt=1&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
            <script src="https://player.vimeo.com/api/player.js"></script>
        @else
            <p>Vidéo invalide</p>
        @endif

    </div>
@endif
