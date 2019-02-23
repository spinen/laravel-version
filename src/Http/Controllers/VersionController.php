<?php

namespace Spinen\Version\Http\Controllers;

use Illuminate\Routing\Controller;

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
     * @return string
     */
    public function version()
    {
        return app_version()->semver;
    }
}
