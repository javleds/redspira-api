<?php

return [
    'base_url' => 'http://app.respira.org.mx/lib/xajax',
    'api_base_url' => 'http://app.respira.org.mx/ws/',

    'endpoints' => [
        'device' => 'get-monitor-data.php',
        'area' => 'get-area-data.php',
        'area_tree' => 'get-area-tree.php',
        'devices' => 'get_monitores_ultima_lectura.php',
    ],

    // Display request debug on console after each request
    'debug_requests' => true,
];