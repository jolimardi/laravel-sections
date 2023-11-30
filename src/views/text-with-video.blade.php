<div @class([
    'section cke-content',
    'section--' . $section->template_name,
    'sectionkey--' . $section->keyClassname,
    $section->classname,
    'reverse' => $section->reverse,
])>
    <div class="max-width-large">

        <div class="text-with-video">

            {{-- Video --}}
            @if(isset($section->video[0]))
                <div class="video-container">
                    {{--Juste thumbnail fancybox : <x-video-popup :video='$section->video[0]' />--}}
                    {{-- Autoplay --}}
                    <x-video-inline :video='$section->video[0]' />
                </div>
            @endif


            <div class="text-container text-white">
                <div class="text">

                    {{-- Subheading --}}
                    @empty(!$section->subheading)
                        <h5 class="subheading text-accent">{{ $section->subheading }}</h5>
                    @endempty

                    {{-- Title --}}
                    @empty(!$section->title)
                        <h2>{!! $section->title !!}</h2>
                    @endempty

                    {{-- Content CKE --}}
                    {!! $section->p !!}


                    @if (!empty($section->cta_title) || !empty($section->cta_secondary_title))
                        <div class="btns">
                            {{-- CTA --}}
                            @empty(!$section->cta_title)

                                @if (!empty($section->cta_routename))
                                    <a href="{{ route($section->cta_routename) }}" class="btn btn-blue">{{ $section->cta_title }} {{ svg('coolicon-chevron-right-md', 'chevron-right') }}</a>
                                @else
                                    <a href="{{ $section->cta_href }}" class="btn btn-blue">{{ $section->cta_title }} {{ svg('coolicon-chevron-right-md', 'chevron-right') }}</a>
                                @endif
                            @endempty

                            {{-- secondary CTA --}}
                            @empty(!$section->cta_secondary_title)
                                @if (!empty($section->cta_secondary_routename))
                                    <a href="{{ route($section->cta_secondary_routename) }}" class="btn btn-blue">{{ $section->cta_secondary_title }}</a>
                                @else
                                    <a href="{{ $section->cta_secondary_href }}" class="btn btn-blue">{{ $section->cta_secondary_title }}</a>
                                @endif
                            @endempty
                        </div>
                    @endif


                    @if (isset($section->getMedia('photos')[0]))
                        <div class="section-photos">
                            @foreach ($section->getMedia('photos') as $photo)
                                <a href="{{ $photo->getUrl() }}" data-fancybox="photos-{{ $section->keyClassname }}">
                                    {{ $photo->img('', ['alt' => $section->title]) }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>