<?php

return [
    'token' => env('WA_TOKEN', ''),
    'base_url' => env('WA_BASE_URL', 'https://chat-service.qontak.com/api/open'),
    'channel' => env('WA_CHANNEL', ''),
    'template' => env('WA_TEMPLATE', ''),
    'template_psb' => env('WA_TEMPLATE_PSB', ''),
    'template_psb_terbayar' => env('WA_TEMPLATE_PSB_TERBAYAR', ''),
];
