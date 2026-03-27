<?php

declare(strict_types=1);

namespace KwtSMS\WHMCS\Tests\Unit;

use PHPUnit\Framework\TestCase;
use KwtSMS\WHMCS\TemplateParser;

/**
 * Tests for TemplateParser::defaultTemplates().
 * parse() requires Capsule (WHMCS DB) so it is not unit-testable.
 * No WHMCS runtime required.
 */
class TemplateParserTest extends TestCase
{
    public function testDefaultTemplatesReturnsArray(): void
    {
        $templates = TemplateParser::defaultTemplates();
        $this->assertIsArray($templates);
        $this->assertNotEmpty($templates);
    }

    public function testDefaultTemplatesContainPhase1Events(): void
    {
        $templates = TemplateParser::defaultTemplates();

        $this->assertArrayHasKey('tpl_client_registration', $templates);
        $this->assertArrayHasKey('tpl_invoice_paid', $templates);
        $this->assertArrayHasKey('tpl_admin_new_order', $templates);
    }

    public function testDefaultTemplatesContainArabic(): void
    {
        $templates = TemplateParser::defaultTemplates();

        $this->assertArrayHasKey('tpl_client_registration_ar', $templates);
        $this->assertArrayHasKey('tpl_invoice_paid_ar', $templates);
    }

    public function testDefaultTemplatesContainPlaceholders(): void
    {
        $templates = TemplateParser::defaultTemplates();

        // All templates should have at least one placeholder
        foreach ($templates as $key => $template) {
            $this->assertMatchesRegularExpression(
                '/\{[a-z]+\}/',
                $template,
                "Template '{$key}' should contain at least one {placeholder}"
            );
        }
    }

    public function testDefaultTemplatesContainCompanyNamePlaceholder(): void
    {
        $templates = TemplateParser::defaultTemplates();

        foreach ($templates as $key => $template) {
            $this->assertStringContainsString(
                '{companyname}',
                $template,
                "Template '{$key}' should contain {companyname} placeholder"
            );
        }
    }

    public function testDefaultTemplatesAreNotEmpty(): void
    {
        $templates = TemplateParser::defaultTemplates();

        foreach ($templates as $key => $template) {
            $this->assertNotEmpty($template, "Template '{$key}' should not be empty");
            $this->assertGreaterThan(10, strlen($template), "Template '{$key}' should be at least 10 chars");
        }
    }

    public function testArabicTemplatesContainArabicChars(): void
    {
        $templates = TemplateParser::defaultTemplates();

        $arabicKeys = array_filter(array_keys($templates), fn($k) => str_ends_with($k, '_ar'));
        $this->assertNotEmpty($arabicKeys, 'Should have at least one Arabic template');

        foreach ($arabicKeys as $key) {
            $this->assertMatchesRegularExpression(
                '/[\x{0600}-\x{06FF}]/u',
                $templates[$key],
                "Arabic template '{$key}' should contain Arabic characters"
            );
        }
    }
}
