<x-filament-widgets::widget style="--cols-lg: none; --cols-md: none;" class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
    @forelse($orders as $index => $order)
    @php
           $deadline = \Carbon\Carbon::parse($record->deadline);
    $created_at = \Carbon\Carbon::now();
    $diff = $deadline->diffInDays($created_at, false);
    $color = '';
    if ($diff <= 1) {
        $color = '#E95142'; // darker red
    } elseif ($diff <= 4) {
        $color = '#1FABF1'; // darker blue
    } elseif ($diff <= 10) {
        $color = '#F1CD2E'; // darker yellow
    } else {
        $color = '#56C453'; // darker green
    }

        <x-filament::section class="p-2 rounded">
            <a href="/orders/show/{{ $order->id }}">
                <div class="flex mb-5">
                    <p class="mb-2"><span style="background-color: {{ $color }}; border-radius: 5px; padding: 10px;font-size:20px;font-weight:bold">{{ $diff }}</span></p>
                    <p class="mb-2 ml-2 text-lg">{{ $order->taille }}</p>
                </div>


                    <img class="rounded h-[300px] p-2 border" src="{{ asset('storage/' . $order->images[0]) }}" alt="Order Image">


                <p class="mt-3 text-lg">Posted On: {{ $order->created_at }}</p>
                <p class="mt-3 text-lg">{{ $order->description }}</p>

            </a>

            </x-filament::section>
            @empty
                <p class="text-center">No data</p>
            @endforelse
</x-filament-widgets::widget>
