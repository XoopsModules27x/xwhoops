# Changelog

## 2.0.0-Beta1 - 2026-07-02

- Targeted the XOOPS 2.7 line: require XOOPS 2.7.0+ and PHP 8.2+.
- Published as the Composer package `xoops/xwhoops`, installable with `composer require xoops/xwhoops` via the [XOOPS module-installer-plugin](https://github.com/XOOPS/module-installer-plugin).
- Corrected the `composer.json` license identifier to `GPL-2.0-or-later` and added package metadata (keywords, homepage, authors, support).
- Rewrote the README for the 2.7 line and Composer-first installation.

## 1.0.1 - 2026-04-25

- Guarded Whoops registration behind `XOOPS_DEBUG`, authenticated site-admin access, and the module permission.
- Prevented the admin example error path from firing when XOOPS debug is disabled.
- Added strict typing and a direct-access guard to the scaffold example class.
- Declared the PHP 8.2 runtime requirement in `composer.json`.
- Documented production safety requirements in README and SECURITY.
