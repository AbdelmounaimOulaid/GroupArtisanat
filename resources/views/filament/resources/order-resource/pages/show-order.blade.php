<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<x-filament-panels::page>
    @php
        $deadline = \Carbon\Carbon::parse($record->deadline);
        $created_at = \Carbon\Carbon::now();
        $diff = $created_at->diffInDays($deadline, false); // Get signed difference
        $color = '';

        if ($diff < 0) {
            $color = '#E95142'; // darker red for past deadlines
        } elseif ($diff <= 1) {
            $color = '#E95142'; // darker red
        } elseif ($diff <= 4) {
            $color = '#1FABF1'; // darker blue
        } elseif ($diff <= 10) {
            $color = '#F1CD2E'; // darker yellow
        } else {
            $color = '#56C453'; // darker green
        }
    @endphp
    <x-filament::section class="rounded lg:text-center">
        <div class="flex flex-col mb-5 lg:flex-row lg:justify-between">
            <p class="mb-2"><span
                    style="background-color: {{ $color }};"
                    class="lg:p-[10px] rounded-md lg:text-[30px] text-[20px] p-[5px] font-bold"
                    >{{ $diff }}</span>
            </p>
            <p class="mb-2 ml-2 text-lg font-bold lg:text-2xl">{{ $record->taille }}</p>
        </div>

        <!-- Swiper Main Gallery -->
        <div class="swiper mySwiper2 lg:w-[60%] lg:h-[60%]">
            <div class="swiper-wrapper">
                @foreach ($record->images as $image)
                    <div class="swiper-slide">
                        <img class="object-cover w-full h-full mt-2 border rounded"
                            src="{{ asset('storage/' . $image) }}" alt="Order Image">
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <!-- Swiper Thumbnail Gallery -->
        <div class="swiper mySwiper mt-5 lg:w-[60%] lg:h-[60%]">
            <div class="swiper-wrapper">
                @foreach ($record->images as $image)
                    <div class="swiper-slide">
                        <img class="rounded w-full lg:h-[150px] h-[70px]  object-cover border mt-2"
                            src="{{ asset('storage/' . $image) }}" alt="Order Image">
                    </div>
                @endforeach
            </div>
        </div>

        <p class="mt-3 text-lg">Posted On: {{ $record->created_at }}</p>
        <p class="mt-3 text-xl font-semibold">{{ $record->description }}</p>

    </x-filament::section>
</x-filament-panels::page>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".mySwiper2", {
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: swiper,
        },
    });
</script>
