@extends('layouts.base')

@section('body')

@isset($slot)
{{ $slot }}
@endisset

@livewire('livewire-ui-modal')
@stack('script')
@endsection
