@extends('layouts.base')

@section('meta')
@stack('style')
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-YYKBQJG9V9"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-YYKBQJG9V9');
</script>
@endsection

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
@stack('script')
@endsection
