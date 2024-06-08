<x-filament-widgets::widget style="--cols-lg: none;" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($orders as $order)
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
            <p class="mb-2">Days until deadline: <span style="background-color: {{ $color }};padding:10px; border-radius: 5px; padding: 2px;">{{ $diff }}</span></p>
            <p class="mb-2">Taille: {{ $order->taille }}</p>
            <p class="mb-2">Order Description: {{ $order->description }}</p>
            @foreach($order->images as $image)
                <a href="{{ asset('storage/' . $image) }}" data-lightbox="order-{{ $order->id }}">
                    <img class="rounded p-2 border" src="{{ asset('storage/' . $image) }}" alt="Order Image">
                </a>
            @endforeach    
        </x-filament::section>
    @empty
        <p class="text-center">No data</p>
    @endforelse
</x-filament-widgets::widget>