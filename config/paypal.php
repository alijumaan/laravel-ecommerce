<?php

return [
    'client_id' => env('PAYPAL_CLIENT_ID', 'Aaqco3nIPqsLzJoIsGnkE1bscCDPmPkyGUOgTbRzNFfAg_QowlV2R3XhMjpGM25CVbfRGJBGaJF5bDLI'),
    'secret' => env('PAYPAL_SECRET', 'ECtirpK9v9UNofFiaUJLXvIkqRwfR126_IuBMjn1wow8XmLQ8osQpSKIzgqolsZZxRvmU1LvK_b0N-vS'),
    'settings' => array(
        'mode' => env('PAYPAL_MODE', 'sandbox'),
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/paypal.log',
        'log.LogLevel' => 'ERROR'
    ),
];
