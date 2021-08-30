@extends('layouts.base')

@section('meta')
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

@isset($slot)
{{ $slot }}
@endisset

@livewire('livewire-ui-modal')
@stack('script')
@endsection
