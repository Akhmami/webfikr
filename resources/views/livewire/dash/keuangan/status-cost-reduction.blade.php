<x-badge color="{{$data->is_used === 'Y' ? 'green' : 'red'}}" :text="$data->is_used === 'Y' ? 'used' : 'unused'" />
