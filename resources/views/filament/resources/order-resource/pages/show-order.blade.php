<x-filament-panels::page>        
@php
            $deadline = \Carbon\Carbon::parse($record->deadline);
            $created_at = \Carbon\Carbon::parse($record->created_at);
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
            <a href="/admin/orders/show/{{ $record->id }}">
                <div class="flex mb-5">
                    <p class="mb-2"><span style="background-color: {{ $color }}; border-radius: 5px; padding: 10px;font-size:20px;font-weight:bold">{{ $diff }}</span></p>
                    <p class="mb-2 ml-2 text-lg">{{ $record->taille }}</p>
                </div>
                
                
                    <img class="rounded h-[300px] p-2 border" src="{{ asset('storage/' . $record->images[0]) }}" alt="Order Image">
                
                
                <p class="mt-3 text-lg">Posted On: {{ $record->created_at }}</p>
                <p class="mt-3 text-lg">{{ $record->description }}</p>
                
            </a>

            </x-filament::section>
</x-filament-panels::page>
