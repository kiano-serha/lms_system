<div class="accordion mt-3" id="accordion-example">
    @foreach ($course->courseSections as $section)
        <div class="accordion-item mb-2 border rounded">
            <h2 class="accordion-header" id="heading-1">
                <button class="accordion-button " type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-{{ $section->id }}" aria-expanded="true">
                    {{ $section->title }}
                </button>
            </h2>
            <div id="collapse-{{ $section->id }}" class="accordion-collapse collapse"
                data-bs-parent="#accordion-example">
                <div class="accordion-body pt-0">
                    {{-- <strong>This is the first item's accordion body.</strong> It is hidden by default, until the
                    collapse
                    plugin adds the appropriate classes that we use to style each element. These classes control the
                    overall
                    appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with
                    custom CSS or overriding our default variables. It's also worth noting that just about any HTML can
                    go
                    within the <code>.accordion-body</code>, though the transition does limit overflow. --}}
                    @foreach ($section->contents as $content)
                        <div class="fw-bold">{{ $content->title }}</div>
                        <div class="mb-1">{{ $content->description }}</div>
                        <div class="mb-3">
                            @foreach ($content->links as $link)
                                <div class="d-flex">
                                    @if ($link->type == 'video')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-video text-muted">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M15 10l4.553 -2.276a1 1 0 0 1 1.447 .894v6.764a1 1 0 0 1 -1.447 .894l-4.553 -2.276v-4z" />
                                            <path
                                                d="M3 6m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" />
                                        </svg>
                                    @elseif($link->type == 'audio')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-ear">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M6 10a7 7 0 1 1 13 3.6a10 10 0 0 1 -2 2a8 8 0 0 0 -2 3a4.5 4.5 0 0 1 -6.8 1.4" />
                                            <path d="M10 10a3 3 0 1 1 5 2.2" />
                                        </svg>
                                    @elseif($link->type == 'article')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-percent">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 17l4 -4" />
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <path d="M10 13h.01" />
                                            <path d="M14 17h.01" />
                                        </svg>
                                    @endif
                                    <a href="{{ $link->title }}"
                                        class="text-decoration-underline mx-2">{{ $link->title }}</a>
                                </div>
                            @endforeach
                        </div>
                        {{-- <br>
                        <br> --}}
                    @endforeach
                    <button class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l5 5l10 -10" />
                        </svg>
                        Mark Complete
                    </button>
                </div>
            </div>

        </div>
    @endforeach
</div>
