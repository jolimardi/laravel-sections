@if (isset($video))

    <div class="video-thumbnail ratio-16x9">

        {{-- Youtube --}}
        @if ($video->service == 'youtube')
            <iframe src="https://www.youtube-nocookie.com/embed/{{ $video->video_id }}?&loop=1&playlist={{ $video->video_id }}&rel=0&controls=1&autoplay=1&mute=1&start=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>


        {{-- Vimeo --}}
        @elseif($video->service == 'vimeo')
            {{-- Version avec controles (moins joli mais plus simple si pas de JS pour unmute) --}}
            {{-- <iframe class="vimeo-inline-iframe" src="https://player.vimeo.com/video/{{ $video->video_id }}?loop=1&autoplay=1&muted=1&title=0&byline=0&controls=1&dnt=1&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe> --}}



            {{-- Version avec background (pas de possibilité de unmute) --}}
            <iframe class="vimeo-inline-iframe" src="https://player.vimeo.com/video/{{ $video->video_id }}?background=1" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>

            <div class="unmute">@svg('coolicon-volume-off-02', 'volume-0')@svg('coolicon-volume-max', 'volume-1')<span> Activer le son</span></div>

            <img class="image-loading-screen" src="{{ $video->thumbnail_url }}" alt="Chargement... {{ $video->title }}" />

            {{-- 
                /*   Le code JS à mettre dans app.js
                /* Players Viméos Inlines : autoplay et unmute si clic dessus   */
                $('.vimeo-inline-iframe').each(function (id, elem) {
                    var iframe = elem;
                    var player = new Vimeo.Player(iframe);

                    var $unmute = $(iframe).next('.unmute');
                    $unmute.data('volume', 0);
                    if ($unmute.length > 0) {
                        $unmute.on('click', function () {
                            if ($unmute.data('volume') == 0) {
                                player.setVolume(1);
                                $unmute.data('volume', 1);
                                $unmute.find('.icon').toggle();
                            } else {
                                player.setVolume(0);
                                $unmute.data('volume', 0);
                                $unmute.find('.icon').toggle();
                            }
                        });
                    }

                    var $loadingCover = $(iframe).siblings('.image-loading-screen');
                    if ($loadingCover.length > 0) {
                        var loadingCoverRemoved = false;
                        player.on('play', function () {
                            console.log('playing, removing cover', $loadingCover);
                            if (!loadingCoverRemoved) {
                                $loadingCover.fadeOut(300);
                                loadingCoverRemoved = true;
                            }
                        });
                    }
                });
            --}}



            @pushOnce('scripts')
                <script src="https://player.vimeo.com/api/player.js"></script>
            @endpushonce
        @else
            <p>Vidéo invalide</p>
        @endif

    </div>
@endif
