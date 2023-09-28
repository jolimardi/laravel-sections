@if (isset($youtube))
    <div class="video-thumbnail ratio-16x9">

        <iframe src="https://www.youtube-nocookie.com/embed/{{ $youtube }}?&loop=1&playlist={{ $youtube }}&rel=0&controls=1&autoplay=1&mute=1&start=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>

    </div>
@endif
