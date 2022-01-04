<x-badge color="{{ $data->is_paid === 'Y' ? 'green' : 'red' }}"
    :text="$data->is_paid === 'Y' ? 'paid' : ($data->datetime_expired <= \Carbon\Carbon::now() ? 'expired' : 'unpaid')" />
