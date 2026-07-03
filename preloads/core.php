<?php declare(strict_types=1);

//namespace XoopsModules\Xwhoops;

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use Xmf\Module\Helper\Permission;

/**
 * @copyright 2000-2026 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2.0 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @author    Richard Griffith <richard@geekwright.com>
 */
class XwhoopsCorePreload extends \XoopsPreloadItem
{
    private const AUTOLOADER_PATH = '/vendor/autoload.php';
    private const PERMISSION_NAME = 'use_xwhoops';
    private const PERMISSION_ITEM_ID = 0;

    /**
     * eventCoreIncludeCommonAuthSuccess
     */
    public static function eventCoreIncludeCommonAuthSuccess(): void
    {
        if (! self::shouldRegisterWhoops()) {
            return;
        }

        // Skip Whoops registration cleanly if the autoloader is missing.
        if (! self::initializeAutoloader()) {
            return;
        }
        self::initializeWhoops();
    }

    /**
     * Whoops exposes source code, request data, and environment details.
     * Keep it disabled unless XOOPS debug is enabled and an authenticated
     * site admin is viewing the request.
     */
    private static function shouldRegisterWhoops(): bool
    {
        if (! \defined('XOOPS_DEBUG') || ! XOOPS_DEBUG) {
            return false;
        }

        $xoopsUser = $GLOBALS['xoopsUser'] ?? null;
        if (! $xoopsUser instanceof \XoopsUser) {
            return false;
        }

        $module = \XoopsModule::getByDirname('xwhoops');
        if (! $module instanceof \XoopsModule) {
            return false;
        }

        return $xoopsUser->isAdmin((int) $module->getVar('mid'));
    }

    /**
     * Load the Whoops vendored autoloader. Returns true on success.
     *
     * The original implementation threw a RuntimeException here, which fatals
     * every page load via `eventCoreIncludeCommonAuthSuccess`, including the
     * admin pages the user would need to disable or repair this module. Emit
     * a non-fatal warning instead, and let initializeWhoops() detect the
     * missing autoloader and skip Whoops registration cleanly.
     *
     * @return bool true if the autoloader was loaded
     */
    private static function initializeAutoloader(): bool
    {
        $autoloader = \dirname(__DIR__) . self::AUTOLOADER_PATH;

        if (! \file_exists($autoloader)) {
            \trigger_error(
                'xwhoops: vendor/autoload.php missing — '
                . "run 'composer install' inside modules/xwhoops "
                . 'or reinstall the module from a release tarball. '
                . 'Whoops error handler is disabled until then.',
                \E_USER_WARNING
            );

            return false;
        }

        require_once $autoloader;

        return true;
    }

    private static function initializeWhoops(): void
    {
        $permissionHelper = new Permission('xwhoops');
        if ($permissionHelper->checkPermission(self::PERMISSION_NAME, self::PERMISSION_ITEM_ID, false)) {
            self::registerWhoops();
        }
    }

    private static function registerWhoops(): void
    {
        $whoops = new Run();
        $handler = new PrettyPageHandler();
        $handler->setPageTitle('XOOPS Debug');

        $whoops->pushHandler($handler);
        $whoops->register();

        $handler->addDataTableCallback(
            \defined('_LOGGER_QUERIES') ? \_LOGGER_QUERIES : 'Queries',
            static fn (): array => self::getLoggerQueries()
        );
    }

    /**
     * @return array|string[]
     */
    private static function getLoggerQueries(): array
    {
        $logger = \XoopsLogger::getInstance();

        if (false === $logger->renderingEnabled) {
            return ['XoopsLogger' => 'off'];
        }

        $queries = [];
        $count = 1;

        foreach ($logger->queries as $query) {
            $queries[$count] = self::formatQuery($query, $count);
            $count++;
        }

        return $queries;
    }

    private static function formatQuery(array $query, int $count): string
    {
        $error = (null === $query['errno'] ? '' : $query['errno'] . ' ') . ($query['error'] ?? '');
        $queryTime = isset($query['query_time']) ? \sprintf('%0.6f', $query['query_time']) : '';
        $queryKey = $count . ' - ' . ($queryTime ?: 'No Time');

        if (null !== $query['errno']) {
            $queryKey = $count . ' - Error';
        }

        return $queryKey . ': ' . \htmlentities((string) $query['sql'], \ENT_QUOTES | \ENT_HTML5) . ' ' . $error;
    }
}
