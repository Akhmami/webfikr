@extends('layouts.base')

@section('meta')
@stack('style')
@endsection

@section('body')

<x-loading-indicator />

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
@stack('script')
@endsection
