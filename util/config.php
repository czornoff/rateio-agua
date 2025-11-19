<?php
    $_config = [
        'db' => [
            'HOST' => 'localhost',
            'USER' => 'root',
            'PASS' => '',
            'NAME' => 'condrembrandt'
        ],
        'app' => [
            'NAME' => 'NOME DA APLICAÇÃO',
            'URL' => 'http://localhost/condrembrandt/',
            'DEBUG' => true
        ],
        'smtp' => [
            'HOST' => 'smtp.example.com',
            'PORT' => 587,
            'USER' => '',
            'PASS' => ''
        ],
        'ia' => [
            'KEY'   => 'SUA_CHAVE_DE_API',
            'MODEL' => 'gemini-2.5-pro',
            'URL'   => 'https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent'
        ]
    ];