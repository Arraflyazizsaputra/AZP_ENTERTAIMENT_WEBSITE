<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

// Pastikan Anda menambahkan namespace untuk filter kustom Anda
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use App\Filters\AuthFilter; // <<< IMPORT FILTER BARU ANDA

class Filters extends BaseConfig
{
    /**
     * Aliases that are used to assign a filter to a named short-cut.
     *
     * @var array<string, string>
     */
    public array $aliases = [
        
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,
        'auth' => \App\Filters\AuthFilter::class,
        
        
    ];

    /**
     * List of special required filters.
     *
     * The filters listed here are special. They are applied before and after
     * other kinds of filters, and always applied even if a route does not exist.
     *
     * @see https://codeigniter.com/user_guide/incoming/filters.html#provided-filters
     *
     * @var array{before: list<string>, after: list<string>}
     */
    public array $required = [
        'before' => [
            'forcehttps', // Force Global Secure Requests
            'pagecache',  // Web Page Caching
        ],
        'after' => [
            'pagecache',   // Web Page Caching
            'performance', // Performance Metrics
            'toolbar',     // Debug Toolbar
        ],
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array{
     * before: array<string, array{except: list<string>|string}>|list<string>,
     * after: array<string, array{except: list<string>|string}>|list<string>
     * }
     */
    public array $globals = [
    'before' => [
        // 'auth', <--- JANGAN ada ini di sini! Hapus jika ada.
        'csrf',
    ],
    'after' => [
        'toolbar',
    ],
];

    /**
     * List of filter aliases that works on a specific HTTP method
     *
     * @var array<string, list<string>>
     */
    public array $methods = [];

    /**
     * List of filter aliases that are applied on a specific set of routes
     *
     * @var array<string, list<string>>
     */
    public array $filters = [];
}