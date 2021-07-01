@foreach ($user->getRoleNames() as $item)
<x-badge color="red" :text="$item" />
@endforeach
