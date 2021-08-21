<x-badge color="{{ $biller->is_active === 'Y' ? 'green' : 'gray' }}"
    :text="$biller->is_active === 'Y' ? 'active' : 'inactive'" />
