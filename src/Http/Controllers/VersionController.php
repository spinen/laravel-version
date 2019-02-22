<?php

namespace App\Http\Controllers;

/**
 * Class VersionController
 *
 * @package App\Http\Controllers
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
