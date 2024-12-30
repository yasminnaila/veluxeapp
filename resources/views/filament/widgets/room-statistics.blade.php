<x-filament::widget>
    <x-filament::card>
        <h2 class="text-lg font-bold">Top 5 Rooms with Most Reservations</h2>
        <ul>
            @foreach ($rooms as $room)
                <li>{{ $room->name }} - {{ $room->reservations_count }} reservations</li>
            @endforeach
        </ul>
    </x-filament::card>
</x-filament::widget>
