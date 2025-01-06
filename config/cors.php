<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS Configuration
    |--------------------------------------------------------------------------
    |
    | This file is where you can configure your settings for Cross-Origin
    | Resource Sharing (CORS). By default, requests from any origin are
    | allowed. You can configure the specific allowed origins, methods,
    | headers, and more here.
    |
    */

    'paths' => [
        'api/*',             // Allow CORS for all API routes (e.g., /api/applicant/register)
        'sanctum/csrf-cookie', // Allow access to the Sanctum CSRF cookie for authentication
    ],

    'allowed_methods' => ['*'],  // Allow all HTTP methods (GET, POST, PUT, DELETE, etc.)

    'allowed_origins' => [
        'http://localhost:5174',  // Allow Vite development server
        'http://127.0.0.1:5174', // Another variant (use whichever matches your frontend's URL)
    ],

    'allowed_origins_patterns' => [],  // Use this if you want pattern matching for origins

    'allowed_headers' => [
        'Content-Type', 
        'X-XSRF-TOKEN',        // Allow CSRF token header for cross-origin requests
        'Authorization',        // Allow Authorization header for API requests
        'Accept',               // Allow Accept header for response formatting
    ],

    'exposed_headers' => [
        // Expose specific headers to the browser (optional)
        'X-Total-Count',
    ],

    'max_age' => 0,  // Max age for preflight requests (0 means no cache)

    'supports_credentials' => true,  // Allow cookies and credentials to be sent with requests

];
