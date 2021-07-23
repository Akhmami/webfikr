<x-badge color="{{ $data->is_active === 'Y' ? 'green' : 'gray' }}"
    :text="$data->is_active === 'Y' ? 'active' : 'inactive'" />
