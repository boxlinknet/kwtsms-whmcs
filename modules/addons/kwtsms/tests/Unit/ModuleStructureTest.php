<?php

declare(strict_types=1);

namespace KwtSMS\WHMCS\Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * Verifies all required module files exist and classes are loadable.
 * No WHMCS runtime required.
 */
class ModuleStructureTest extends TestCase
{
    private const MODULE_DIR = __DIR__ . '/../../';

    /**
     * @dataProvider requiredFileProvider
     */
    public function testRequiredFileExists(string $relativePath): void
    {
        $fullPath = realpath(self::MODULE_DIR . $relativePath);
        $this->assertNotFalse($fullPath, "Required file missing: {$relativePath}");
        $this->assertFileExists($fullPath);
    }

    /**
     * @return array<string, array{string}>
     */
    public static function requiredFileProvider(): array
    {
        return [
            'main module file' => ['kwtsms.php'],
            'hooks file' => ['hooks.php'],
            'composer.json' => ['composer.json'],
            'vendor autoload' => ['vendor/autoload.php'],
            'SmsHelper' => ['lib/SmsHelper.php'],
            'GatewayManager' => ['lib/GatewayManager.php'],
            'Logger' => ['lib/Logger.php'],
            'TemplateParser' => ['lib/TemplateParser.php'],
            'CronHelper' => ['lib/CronHelper.php'],
            'english lang' => ['lang/english.php'],
            'arabic lang' => ['lang/arabic.php'],
            'dashboard template' => ['templates/admin/dashboard.tpl'],
            'settings template' => ['templates/admin/settings.tpl'],
            'templates template' => ['templates/admin/templates.tpl'],
            'integrations template' => ['templates/admin/integrations.tpl'],
            'logs template' => ['templates/admin/logs.tpl'],
            'help template' => ['templates/admin/help.tpl'],
            'style partial' => ['templates/admin/_style.php'],
            'nav partial' => ['templates/admin/_nav.php'],
            'gateway_action ajax' => ['templates/ajax/gateway_action.php'],
            'test_sms ajax' => ['templates/ajax/test_sms.php'],
            'clear_log ajax' => ['templates/ajax/clear_log.php'],
        ];
    }

    /**
     * @dataProvider classProvider
     */
    public function testClassIsLoadable(string $className): void
    {
        $this->assertTrue(class_exists($className), "Class {$className} should be autoloadable");
    }

    /**
     * @return array<string, array{string}>
     */
    public static function classProvider(): array
    {
        return [
            'SmsHelper' => ['KwtSMS\\WHMCS\\SmsHelper'],
            'GatewayManager' => ['KwtSMS\\WHMCS\\GatewayManager'],
            'Logger' => ['KwtSMS\\WHMCS\\Logger'],
            'TemplateParser' => ['KwtSMS\\WHMCS\\TemplateParser'],
            'CronHelper' => ['KwtSMS\\WHMCS\\CronHelper'],
            'KwtSMS library' => ['KwtSMS\\KwtSMS'],
            'PhoneUtils library' => ['KwtSMS\\PhoneUtils'],
            'MessageUtils library' => ['KwtSMS\\MessageUtils'],
        ];
    }

    public function testSmsHelperHasSendMethod(): void
    {
        $this->assertTrue(method_exists('KwtSMS\\WHMCS\\SmsHelper', 'send'));
    }

    public function testSmsHelperHasNormalizePhoneMethod(): void
    {
        $this->assertTrue(method_exists('KwtSMS\\WHMCS\\SmsHelper', 'normalizePhone'));
    }

    public function testGatewayManagerHasRequiredMethods(): void
    {
        $methods = ['login', 'logout', 'reload', 'get', 'set', 'isConfigured', 'isEnabled'];
        foreach ($methods as $method) {
            $this->assertTrue(
                method_exists('KwtSMS\\WHMCS\\GatewayManager', $method),
                "GatewayManager::{$method}() must exist"
            );
        }
    }

    public function testLoggerHasRequiredMethods(): void
    {
        $methods = ['log', 'logAttempt', 'logDebug'];
        foreach ($methods as $method) {
            $this->assertTrue(
                method_exists('KwtSMS\\WHMCS\\Logger', $method),
                "Logger::{$method}() must exist"
            );
        }
    }

    public function testTemplateParserHasRequiredMethods(): void
    {
        $methods = ['parse', 'defaultTemplates'];
        foreach ($methods as $method) {
            $this->assertTrue(
                method_exists('KwtSMS\\WHMCS\\TemplateParser', $method),
                "TemplateParser::{$method}() must exist"
            );
        }
    }

    public function testCronHelperHasSyncMethod(): void
    {
        $this->assertTrue(method_exists('KwtSMS\\WHMCS\\CronHelper', 'syncGateway'));
    }
}
