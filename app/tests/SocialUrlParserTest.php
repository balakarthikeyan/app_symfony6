<?php

// use PHPUnit\Framework\TestCase;
use Monolog\Test\TestCase;
use App\Patterns\SocialUrlParser;
// use PHPUnit\Framework\MockObject\RuntimeException;

final class SocialUrlParserTest extends TestCase
{
    /**
     * @dataProvider socialNetworkProvider
     */
    public function testItReturnsCorrectType(string $url, ?string $expectedType): void
    {
        $parser = new SocialUrlParser();

        $this->assertSame($expectedType, $parser->getType($url));
    }

    public function testItThrowsExceptionForInvalidUrl(): void
    {
        $parser = new SocialUrlParser();

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('invalid_social_network_url');

        $parser->getType('https://q.agency');
    }

    public function socialNetworkProvider(): array
    {
        return [
            ['https://www.facebook.com/teste...', 'facebook'],
            ['https://www.linkedin.com/in/te...', 'linkedin'],
            ['https://twitter.com/tester', 'twitter'],
        ];
    }
}