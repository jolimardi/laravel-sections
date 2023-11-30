<div @class([
    'section cke-content',
    'section--' . $section->template_name,
    'sectionkey--' . $section->key_classname,
    $section->classname,
    'reverse' => $section->reverse,
])>
    <div class="{{ $section->max_width ?? 'max-width' }}">

        <div class="text-and-image">

            @if ($section->getFirstMedia('image'))
                <div class="section-image">
                    {{ $section->getFirstMedia('image')->img('', ['alt' => $section->title]) }}
                </div>
            @endif

            <div class="text">

                {{-- Subheading --}}
                @empty(!$section->subheading)
                    <h5 class="subheading text-accent">{{ $section->subheading }}</h5>
                @endempty

                {{-- Title --}}
                @empty(!$section->title)
                    <h2 class="with-separator">{!! $section->title !!}</h2>
                @endempty


                {{-- Content CKE --}}
                {!! $section->p !!}


                @if (!empty($section->cta_title) || !empty($section->cta_secondary_title))
                    <div class="btns">
                        {{-- CTA --}}
                        @empty(!$section->cta_title)

                            @if (!empty($section->cta_routename))
                                <a href="{{ route($section->cta_routename) }}" class="btn btn-small btn-primary">{{ $section->cta_title }} {{ svg('coolicon-arrow-right-md') }}</a>
                            @else
                                <a href="{{ $section->cta_href }}" class="btn btn-small btn-primary">{{ $section->cta_title }} {{ svg('coolicon-arrow-right-md') }}</a>
                            @endif
                        @endempty

                        {{-- secondary CTA --}}
                        @empty(!$section->cta_secondary_title)
                            @if (!empty($section->cta_secondary_routename))
                                <a href="{{ route($section->cta_secondary_routename) }}" class="btn btn-small btn-secondary">{{ $section->cta_secondary_title }}</a>
                            @else
                                <a href="{{ $section->cta_secondary_href }}" class="btn btn-small btn-secondary">{{ $section->cta_secondary_title }}</a>
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
