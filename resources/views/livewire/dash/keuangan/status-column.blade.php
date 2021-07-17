<x-badge color="{{ $data->is_paid === 'Y' ? 'green' : 'red' }}" :text="$data->is_paid === 'Y' ? 'paid' : 'unpaid'" />
