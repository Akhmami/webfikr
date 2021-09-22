<div>
    <div class="row"
        style="padding: 15px 0; background-color:@if(session()->has('success')) #dff0d8;@elseif(session()->has('error')) #f2dede;@endif">
        <div class="col-md-8 text-left">
            @if (session()->has('success') || session()->has('error'))
            <div class="fade in" style="color:@if(session()->has('success')) #1fc122;@else #d8312e;@endif">
                @if(session()->has('success'))
                <strong>Success!</strong> {!! session('success') !!}
                @else
                <strong>Oops...!</strong> {!! session('error') !!}
                @endif
            </div>
            @endif
        </div>
        <div class="col-md-4">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
    </div>
</div>
