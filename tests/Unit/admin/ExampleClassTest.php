<?php

namespace Tests\Unit;

use ExampleClass;
use PHPUnit\Framework\TestCase;

/**
 * Class ExampleClassTest.
 *
 * @covers \ExampleClass
 */
final class ExampleClassTest extends TestCase
{
    private ExampleClass $exampleClass;

    private string $msg;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->msg = '42';
        $this->exampleClass = new ExampleClass($this->msg);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->exampleClass);
        unset($this->msg);
    }

    public function testFlawedMethod(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
