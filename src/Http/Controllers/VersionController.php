<?php

namespace Spinen\Version\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
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
     * @param Version $version
     *
     * @return string
     */
    public function version(Version $version)
    {
        return $version->{Config::get('version.route.expose', 'semver')};
    }
}
