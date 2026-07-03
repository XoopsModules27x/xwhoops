<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use XwhoopsCorePreload;

/**
 * Class XwhoopsCorePreloadTest.
 *
 * @copyright 2000-2026 XOOPS Project (https://xoops.org)
 * @license GNU GPL 2.0 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @author Richard Griffith <richard@geekwright.com>
 *
 * @covers \XwhoopsCorePreload
 */
final class XwhoopsCorePreloadTest extends TestCase
{
    private XwhoopsCorePreload $xwhoopsCorePreload;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->xwhoopsCorePreload = new XwhoopsCorePreload();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->xwhoopsCorePreload);
    }

    public function testEventCoreIncludeCommonAuthSuccess(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
