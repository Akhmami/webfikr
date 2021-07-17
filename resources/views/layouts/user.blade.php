@extends('layouts.base')

@section('body')

<div class="bg-gray-100 min-h-screen">
    @include('layouts.user.navbar')

    @isset($slot)
    {{ $slot }}
    @endisset

    @include('layouts.user.footer')
</div>

<livewire:toaster />

@livewire('livewire-ui-modal')
@livewireUIScripts
@endsection
