<?php

use Spinen\Version\Version;

// @codeCoverageIgnoreStart
if (!function_exists('app_version')) {
// @codeCoverageIgnoreEnd
    /**
     * Return the version of the app.
     *
     * @return string
     */
    function app_version()
    {
        return app(Version::class);
    }
}
