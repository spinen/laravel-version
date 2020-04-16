<?php

namespace Spinen\Version\Http\Controllers;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Routing\Controller;
use Spinen\Version\Version;

/**
 * Class VersionController
 *
 * @package Spinen\Version\Http\Controllers
 */
class VersionController extends Controller
{
    /**
     * Return the semver
     *
     * @param Config $config
     * @param Version $version
     *
     * @return string
     */
    public function version(Config $config, Version $version)
    {
        return $version->{$config->get('version.route.expose', 'semver')};
    }
}
