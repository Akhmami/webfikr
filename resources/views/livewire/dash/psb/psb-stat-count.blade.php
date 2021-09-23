<div>
    <div class="flex items-center justify-center space-x-4">
        @foreach ($stat_count as $key => $value)
        <div class="flex items-center space-x-1">
            <span>{{ $key }}</span>
            <x-badge color="blue" :text="$value" />
        </div>
        @endforeach
    </div>
</div>
