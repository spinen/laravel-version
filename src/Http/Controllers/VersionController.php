<?php

namespace Spinen\Version\Http\Controllers;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Routing\Controller;
use Spinen\Version\Version;

/**
 * Class VersionController
 */
class VersionController extends Controller
{
    /**
     * Return the semver
     */
    public function version(Config $config, Version $version): string
    {
        return $version->{$config->get('version.route.expose', 'semver')}.' Hostname: '.gethostname();
    }
}
