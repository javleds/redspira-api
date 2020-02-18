<?php

return [
    'base_url' => 'http://app.respira.org.mx/lib/xajax',
    'api_base_url' => 'http://app.respira.org.mx/ws/',

    'endpoints' => [
        'devices' => 'get_monitores_ultima_lectura.php',
        'device' => 'get-monitor-data.php',
        'areas' => 'get-areas.php',
        'area_tree' => 'get-area-tree.php',
        'area' => 'get-area-data.php',
    ],

    // Display request debug on console after each request
    'debug_requests' => false,
];