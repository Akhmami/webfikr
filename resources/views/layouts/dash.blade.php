@extends('layouts.base')

@section('body')
<!-- navbar goes here -->
@include('layouts.dash.navbar')

<div class="bg-gray-100">
    @isset($slot)
    {{ $slot }}
    @endisset

    <footer class="max-w-7xl mx-auto p-4 py-8">
        <p class="text-gray-500">Copyright &copy; 2021 <a href="">Jendela Kayu</a>. All rights reserved. </p>
    </footer>
</div>

@livewire('livewire-ui-modal')
@livewireUIScripts
@endsection
