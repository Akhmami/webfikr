@extends('layouts.base')

@section('body')

@isset($slot)
{{ $slot }}
@endisset

@livewire('livewire-ui-modal')
@livewireUIScripts
@stack('script')
@endsection
