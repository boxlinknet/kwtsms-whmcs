<?php

declare(strict_types=1);

/**
 * PHPUnit bootstrap for kwtSMS WHMCS module tests.
 *
 * Defines WHMCS constant and stubs for functions that are normally
 * provided by the WHMCS runtime. This allows unit testing without
 * a running WHMCS installation.
 */

// Simulate WHMCS environment
if (!defined('WHMCS')) {
    define('WHMCS', true);
}

// Stub WHMCS global functions used by the module
if (!function_exists('add_hook')) {
    function add_hook(string $hookPoint, int $priority, callable $function): void
    {
        // No-op in tests
    }
}

if (!function_exists('logActivity')) {
    function logActivity(string $message, int $clientId = 0): void
    {
        // No-op in tests
    }
}

require_once dirname(__DIR__) . '/vendor/autoload.php';
