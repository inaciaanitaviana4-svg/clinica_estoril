<?php

return [
    'default' => env('FLASHER_DEFAULT', 'flasher'),

    'drivers' => [
        'flasher' => [
            'root' => env('FLASHER_ROOT', base_path('vendor/flasher')),
            'translate' => env('FLASHER_TRANSLATE', true),
            'inject_assets' => env('FLASHER_INJECT_ASSETS', true),
        ],
    ],

    'presets' => [
        // Your custom presets here
    ],
];