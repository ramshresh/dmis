<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'brandLabel' => 'EMIS',
    'id' => 'GIRC-GeospatialLab@ku',
    'uploadsBasePath'=>'@common/uploads',
    'apps'=>[
        'backend'=>[
            'scriptBasePath'=>'/backend/web',
            'scriptBasePathAlias'=>'admin',
        ],
        'frontend'=>[
            'scriptBasePath'=>'/backend/web',
            'scriptBasePathAlias'=>'',
        ],
        'api'=>[
            'scriptBasePath'=>'/backend/web',
            //'scriptBasePathAlias'=>'api',
        ],
    ]
];
