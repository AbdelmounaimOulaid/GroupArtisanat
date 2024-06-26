<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<x-filament-panels::page>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">

        @forelse($orders as $index => $order)
            <?php
            $deadline = \Carbon\Carbon::parse($order->deadline);
            $created_at = \Carbon\Carbon::now();
$diff = $created_at->diffInDays($deadline, false);
            $color = '';

            if ($diff <= 1) {
                $color = '#E95142'; // darker red
            } elseif ($diff <= 4) {
                $color = '#1FABF1'; // darker blue
            } elseif ($diff < 10) {
                $color = '#F1CD2E'; // darker yellow
            } else {
                $color = '#56C453'; // darker green
            }
            ?>


            <x-filament::section class="p-2 rounded">
                <a href="/orders/show/{{ $order->id }}">
                    <div class="flex flex-col mb-5">
                        <div style="display: flex; flex-direction: row;">
                            <p style="width: 100%; display: flex;justify-content: center;font-weight: bolder;">
                                <span>{{ $order->name }}</span>
                            </p>
                        </div>
                        <p class="mt-5 ml-2 text-lg font-bold whitespace-nowrap">{{ $order->taille }}</p>
                    </div>



                             <!-- Swiper Main Gallery -->
                    <div class="swiper mySwiper2 rounded h-[300px] p-2 border">
                        <div class="swiper-wrapper">
                            @foreach ($order->images as $image)
                                <div class="swiper-slide">
                                    <img class="object-cover w-full h-full mt-2 border rounded"
                                        src="{{ asset('storage/' . $image) }}" alt="Order Image">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                     @if(count($order->images) > 1 )
                    <!-- Swiper Thumbnail Gallery -->
                    <div click="javascript:void(0);" class="swiper mySwiper mt-5 lg:w-[60%] lg:h-[60%]">
                        <div click="javascript:void(0);" class="swiper-wrapper">
                            @foreach ($order->images as $image)
                                <div click="javascript:void(0);" class="swiper-slide">
                                    <img click="javascript:void(0);" class="rounded w-full lg:h-[70px] h-[70px]  object-cover border mt-2"
                                        src="{{ asset('storage/' . $image) }}" alt="Order Image">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <p class="mt-3 text-lg">Posted On: {{ $order->created_at }}</p>
                    <p class="mt-3 text-lg" style="font-weight:bold;">{{ $order->description }}</p>

                </a>

            </x-filament::section>
        @empty
            <p class="text-center">No data</p>
        @endforelse
    </div>
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
