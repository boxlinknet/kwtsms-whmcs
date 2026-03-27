<?php

declare(strict_types=1);

namespace KwtSMS\WHMCS\Tests\Unit;

use PHPUnit\Framework\TestCase;
use KwtSMS\WHMCS\SmsHelper;

/**
 * Tests for SmsHelper::normalizePhone().
 * Uses the kwtsms-php PhoneUtils under the hood.
 * No WHMCS runtime required.
 */
class PhoneNormalizationTest extends TestCase
{
    /**
     * @dataProvider phoneProvider
     */
    public function testNormalizePhone(string $input, string $countryCode, string $expected): void
    {
        $result = SmsHelper::normalizePhone($input, $countryCode);
        $this->assertSame($expected, $result);
    }

    /**
     * @return array<string, array{string, string, string}>
     */
    public static function phoneProvider(): array
    {
        return [
            'Kuwait local 8 digits' => ['98765432', '965', '96598765432'],
            'Kuwait with country code' => ['96598765432', '965', '96598765432'],
            'Kuwait with plus' => ['+96598765432', '965', '96598765432'],
            'Kuwait with 00 prefix' => ['0096598765432', '965', '96598765432'],
            'Kuwait with leading zero' => ['098765432', '965', '96598765432'],
            'Dashes and spaces' => ['00965-98-765-432', '965', '96598765432'],
            'Parentheses and dots' => ['(965) 9876.5432', '965', '96598765432'],
            'US number stays intact' => ['12025551234', '965', '12025551234'],
            'Short number gets country code' => ['5551234', '1', '15551234'],
            'Empty country code no prepend' => ['98765432', '', '98765432'],
            'Arabic digits' => ["\xD9\xA9\xD9\xA8\xD9\xA7\xD9\xA6\xD9\xA5\xD9\xA4\xD9\xA3\xD9\xA2", '965', '96598765432'],
        ];
    }

    public function testNormalizedPhoneIsDigitsOnly(): void
    {
        $result = SmsHelper::normalizePhone('+965 (9876) 5432', '965');
        $this->assertMatchesRegularExpression('/^\d+$/', $result);
    }

    public function testNormalizedPhoneHasNoLeadingZeros(): void
    {
        $result = SmsHelper::normalizePhone('00096598765432', '965');
        $this->assertStringStartsWith('965', $result);
    }
}
