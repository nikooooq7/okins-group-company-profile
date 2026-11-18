<?php
return [
 'paths'=>['api/*','sanctum/csrf-cookie'],
 'allowed_methods'=>['*'],
 // Ganti dengan domain Netlify Anda. Jangan gunakan wildcard untuk produksi.
 'allowed_origins'=>[env('FRONTEND_URL','https://YOUR-SITE.netlify.app'),'http://localhost:5500','http://127.0.0.1:5500'],
 'allowed_origins_patterns'=>[],
 'allowed_headers'=>['*'],
 'exposed_headers'=>[],
 'max_age'=>600,
 'supports_credentials'=>false,
];
