@extends('layouts.base')

@section('body')
<!-- navbar goes here -->
@include('partials.dash.navbar')

<div class="bg-gray-100 min-h-screen">
    <!-- Breadcrumb -->
    @include('partials.dash.breadcrumb')

    <!-- Main -->
    @isset($slot)
    {{ $slot }}
    @endisset

    <!-- Footer -->
    @include('partials.dash.footer')
</div>

<livewire:toaster />

@livewire('livewire-ui-modal')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    window.addEventListener('swal:modal', event => {
            swal({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type,
                button: false,
            });
        });
        window.addEventListener('swal:confirm', event => {
            swal({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type,
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        window.livewire.emit(event.detail.method, event.detail.id);
                    }
                });
        });
</script>
@endsection
