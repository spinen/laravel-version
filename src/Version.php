<?php

namespace Spinen\Version;

use Illuminate\Support\Facades\Config;

/**
 * Class Version
 *
 * Parse the version file into the parts
 *
 * @package App\Support
 */
class Version
{
    /**
     * Major version
     *
     * @var integer|null
     */
    public $major = null;

    /**
     * Meta
     *
     * Extra data about the version with dots separating key data and underscores for spaces
     *
     * @var string|null
     */
    public $meta = null;

    /**
     * Minor version
     *
     * @var integer|null
     */
    public $minor = null;

    /**
     * Patch version
     *
     * @var integer|null
     */
    public $patch = null;

    /**
     * Pre release
     *
     * This will most likely be the branch version, unless we are on the master branch
     *
     * @var string|null
     */
    public $pre_release = null;

    /**
     * Version in SemVer format
     *
     * @var string
     */
    public $semver;

    /**
     * The version of the application
     *
     * @var string
     */
    public $version = "UNDEFINED";

    /**
     * The file that holds the version info
     *
     * @var string
     */
    protected $version_file;

    /**
     * Version constructor.
     *
     * @param string|null $file
     */
    public function __construct($file = null)
    {
        $this->version_file = $file ? : base_path(Config::get('version.file', 'VERSION'));

        $this->parseVersionFile();

        $this->generateSemVer();
    }

    /**
     * If the object is used as a string, then return the full version
     *
     * @return string
     */
    public function __toString()
    {
        return $this->semver;
    }

    /**
     * Put together version parts into the SemVer format
     */
    protected function generateSemVer()
    {
        $this->semver = $this->version;

        if ($this->pre_release) {
            $this->semver .= '-' . $this->pre_release;
        }

        if ($this->meta) {
            $this->semver .= '+' . $this->meta;
        }
    }

    /**
     * If the read in line matches a version, then parse it
     *
     * @param string $version
     *
     * @return bool
     */
    protected function parseVersion($version)
    {
        if (!preg_match('/\\d+\\.\\d+\\.\\d+/u', $version)) {
            return false;
        }

        $this->version = $version;

        list($this->major, $this->minor, $this->patch) = array_map('intval', explode(".", $this->version));

        return true;
    }

    /**
     * Read the version file into the various parts
     */
    protected function parseVersionFile()
    {
        if (!file_exists($this->version_file)) {
            return;
        }

        // Read file in as an array & remove any empty lines
        $version_parts = array_filter(explode("\n", @file_get_contents($this->version_file)));

        // First line is the version
        if (empty($version_parts) or !$this->parseVersion(array_shift($version_parts))) {
            return;
        }

        // Next line is branch/pre release
        $pre_release = array_shift($version_parts);

        $this->pre_release = ($pre_release !== 'master') ? $pre_release : null;

        // Is there anything left in the file for meta?
        if (empty($version_parts)) {
            return;
        }

        // Everything left is the meta, so concatenate it with .'s & replace the spaces with _'s
        $this->meta = preg_replace("/\\s+/u", "_", implode('.', $version_parts));
    }
}
