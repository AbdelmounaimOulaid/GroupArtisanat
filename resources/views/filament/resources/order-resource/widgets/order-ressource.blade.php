<x-filament-widgets::widget style="--cols-lg: none; --cols-md: none;" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($orders as $index => $order)
    @php
            $deadline = \Carbon\Carbon::parse($order->deadline);
            $created_at = \Carbon\Carbon::parse($order->created_at);
            $diff = $deadline->diffInDays($created_at);
            $color = '';
            if ($diff >= 10) {
                $color = '#F1CD2E'; // darker yellow
            } elseif ($diff >= 4) {
                $color = '#1FABF1'; // darker blue
            } elseif ($diff >= 1) {
                $color = '#E95142'; // darker red
            } else {
                $color = '#56C453'; // darker green
            }
        @endphp
        <x-filament::section class="rounded p-2">
            <div class="flex mb-5">
                <p class="mb-2"><span style="background-color: {{ $color }}; border-radius: 5px; padding: 10px;font-size:20px;font-weight:bold">{{ $diff }}</span></p>
                <p class="mb-2 ml-2 text-lg">{{ $order->taille }}</p>
            </div>
            @foreach($order->images as $image)
            <a href="{{ asset('storage/' . $image) }}" data-lightbox="order-{{ $order->id }}">
                <img class="rounded p-2 border" src="{{ asset('storage/' . $image) }}" alt="Order Image">
            </a>
            @endforeach    
            <p class="mt-3 text-lg">Posted On: {{ $order->created_at }}</p>
            <p class="mt-3 text-lg">{{ $order->description }}</p>


            </x-filament::section>
            @empty
                <p class="text-center">No data</p>
            @endforelse
</x-filament-widgets::widget>