<?php

namespace Tests;

use Coduo\PHPMatcher\Factory\MatcherFactory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;
use Webmozart\Assert\Assert;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $matcher;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->matcher = (new MatcherFactory())->createMatcher();
    }

    protected function assertJsonResponseContent(TestResponse $response, string $filePath): void
    {
        $actualResponse = $this->prettifyJson($response->getContent());

        $contents = file_get_contents($filePath);
        Assert::string($contents);

        $expectedResponse = trim($contents);

        $actualResponse = trim($actualResponse);
        $result = $this->matcher->match($actualResponse, $expectedResponse);
        if (!$result) {
            $diff = new \Diff(explode(\PHP_EOL, $expectedResponse), explode(\PHP_EOL, $actualResponse), []);

            self::fail($this->matcher->getError() . \PHP_EOL . $diff->render(new \Diff_Renderer_Text_Unified()));
        }
    }

    protected function prettifyJson($content): string
    {
        $jsonFlags = \JSON_PRETTY_PRINT;
        if (!isset($_SERVER['ESCAPE_JSON']) || true !== $_SERVER['ESCAPE_JSON']) {
            $jsonFlags |= \JSON_UNESCAPED_UNICODE | \JSON_UNESCAPED_SLASHES;
        }

        /** @var string $encodedContent */
        $encodedContent = json_encode(json_decode($content, true), $jsonFlags);

        return $encodedContent;
    }
}
