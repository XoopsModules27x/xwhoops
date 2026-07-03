![alt XOOPS CMS](https://xoops.org/images/logoXoopsPhp81.png)

## xWhoops module for [XOOPS CMS 2.7.0+](https://xoops.org)


[![XOOPS CMS Module](https://img.shields.io/badge/XOOPS%20CMS-Module-blue.svg)](https://xoops.org)
[![Software License](https://img.shields.io/badge/license-GPL-brightgreen.svg?style=flat)](http://www.gnu.org/licenses/gpl-2.0.html)

[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/XoopsModules27x/xwhoops.svg?style=flat)](https://scrutinizer-ci.com/g/XoopsModules27x/xwhoops/?branch=main)
[![Latest Pre-Release](https://img.shields.io/github/tag/XoopsModules27x/xwhoops.svg?style=flat)](https://github.com/XoopsModules27x/xwhoops/tags/)
[![Latest Version](https://img.shields.io/github/release/XoopsModules27x/xwhoops.svg?style=flat)](https://github.com/XoopsModules27x/xwhoops/releases/)

A XOOPS 2.7.0+ module that brings **[whoops](https://github.com/filp/whoops)** error display to XOOPS. It is especially handy for diagnosing failures brought on by unhandled errors, so you can more properly handle them.

Administrators control access to the extended diagnostics, and any group can be granted or denied access.

Whoops is intentionally disabled unless `XOOPS_DEBUG` is enabled and the current viewer is an authenticated site administrator with the xWhoops permission. **Do not enable this module's diagnostic output on a production site with debug disabled.**

Outside of the control panel, there is no user interface. It will "just work" when needed.

The preload registers Whoops during XOOPS `eventCoreIncludeCommonAuthSuccess`, after the authenticated user is available for admin and permission checks.

## Installation

xWhoops is distributed as the Composer package `xoops/xwhoops`.

### Recommended: Composer

If your XOOPS 2.7 site is managed as a Composer project — its root `composer.json` requires [`xoops/module-installer-plugin`](https://github.com/XOOPS/module-installer-plugin) and sets `extra.xoops_modules` — run from the site root:

```bash
composer require xoops/xwhoops
```

This stages the module, together with its `filp/whoops` dependency, into `htdocs/modules/xwhoops`. Then:

- install the *xWhoops* module in the system administration module page
- grant access by selecting groups in the permissions section
- enable `XOOPS_DEBUG` only in a development or controlled troubleshooting environment

One-time site setup (the module-installer-plugin, `extra.xoops_modules`, and `allow-plugins`) is described in the [module-installer-plugin guide](https://github.com/XOOPS/module-installer-plugin/blob/master/docs/composer-module-distribution.md).

### Manual / developer

The module depends on `filp/whoops`, which is **not** bundled in the repository, so a plain file drop-in requires one Composer step to fetch it:

- download or clone this repository into your `htdocs/modules/` directory as `xwhoops`
- open a terminal in that directory and run `composer install`
- install and configure the module as above

## The Whoops display

The Whoops display contains 4 main sections.
- *top left* is the error that was encountered
- *lower left* shows the stack frames, the trace of the path of processing that resulted in the error
- *top right* shows the code for the currently selected stack frame item. Select a new stack frame to see the related code
- *lower right* shows environment information such as request parameters, session information, etc.

Note: if the XoopsLogger is enabled, MySQL queries will be shown in the Environment & details section.

### Please visit us on https://xoops.org

Current and upcoming "next generation" versions of XOOPS CMS are crafted on GitHub at: https://github.com/XOOPS
