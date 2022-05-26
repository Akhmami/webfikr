@if (auth()->user()->grades()->count() > 0)
<livewire:user.bill />
@else
<livewire:user.psb />
@endif