<!-- Slideshow -->
<section class="relative mt-24 h-auto w-full">
    <div id="image-slider" class="splide">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach ($data as $item)
                <li class="splide__slide">
                    <img src="{{ asset($item->image_url) }}" class="object-contain w-full" alt="Slideshow">
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
