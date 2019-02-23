<?php

namespace Spinen\Version;

class VersionTest extends TestCase
{
    /**
     * @test
     * @dataProvider versionFiles
     *
     * @param string $contents Contents of the VERSION file, if null, delete the file
     * @param string $string Expected string version of the parsed version
     * @param string $version Expected <Major>.<Minor>.<Patch> of the parsed version
     * @param string $semver Expected semver of the parsed version
     * @param integer|null $major Expected major of the parsed version
     * @param integer|null $minor Expected minor of the parsed version
     * @param integer|null $patch Expected patch of the parsed version
     * @param string|null $pre_release Expected pre release of the parsed version
     * @param string|null $meta Expected meta of the parsed version
     */
    public function it_parses_version_files_as_expected(
        $contents,
        $string,
        $version,
        $semver,
        $major,
        $minor,
        $patch,
        $pre_release,
        $meta
    ) {
        // If no content for the file, then delete it, otherwise, set the content
        is_null($contents) ? $this->root->removeChild("VERSION") : $this->version_file->setContent($contents);

        $parser = new Version($this->version_file->url());

        $this->assertEquals($string, (string)$parser);
        $this->assertEquals($version, $parser->version);
        $this->assertEquals($semver, $parser->semver);
        $this->assertEquals($major, $parser->major);
        $this->assertEquals($minor, $parser->minor);
        $this->assertEquals($patch, $parser->patch);
        $this->assertEquals($pre_release, $parser->pre_release);
        $this->assertEquals($meta, $parser->meta);
    }

    public function versionFiles()
    {
        return [
            'simple version file'                => [
                '1.2.0', // contents
                '1.2.0', // string
                '1.2.0', // version
                '1.2.0', // semver
                1, // major
                2, // minor
                0, // patch
                null, // pre_release
                null, // meta
            ],
            'empty version file'                 => [
                '', // contents
                'UNDEFINED', // string
                'UNDEFINED', // version
                'UNDEFINED', // semver
                null, // major
                null, // minor
                null, // patch
                null, // pre_release
                null, // meta
            ],
            'invalid version file'               => [
                'a.b.c', // contents
                'UNDEFINED', // string
                'UNDEFINED', // version
                'UNDEFINED', // semver
                null, // major
                null, // minor
                null, // patch
                null, // pre_release
                null, // meta
            ],
            'missing version file'               => [
                null, // contents
                'UNDEFINED', // string
                'UNDEFINED', // version
                'UNDEFINED', // semver
                null, // major
                null, // minor
                null, // patch
                null, // pre_release
                null, // meta
            ],
            'complex version file'               => [
                "1.2.0\n\nbranch\nsha:value\nmeta\ndata\nwith spaces", // contents
                '1.2.0-branch+sha:value.meta.data.with_spaces', // string
                '1.2.0', // version
                '1.2.0-branch+sha:value.meta.data.with_spaces', // semver
                1, // major
                2, // minor
                0, // patch
                'branch', // pre_release
                'sha:value.meta.data.with_spaces', // meta
            ],
            'no meta version file'               => [
                "1.2.0\n\nbranch", // contents
                '1.2.0-branch', // string
                '1.2.0', // version
                '1.2.0-branch', // semver
                1, // major
                2, // minor
                0, // patch
                'branch', // pre_release
                null, // meta
            ],
            'master branch version file'         => [
                "1.2.0\n\nmaster", // contents
                '1.2.0', // string
                '1.2.0', // version
                '1.2.0', // semver
                1, // major
                2, // minor
                0, // patch
                null, // pre_release
                null, // meta
            ],
            'complex master branch version file' => [
                "1.2.0\n\nmaster\nsha:value\nmeta\ndata\nwith spaces", // contents
                '1.2.0+sha:value.meta.data.with_spaces', // string
                '1.2.0', // version
                '1.2.0+sha:value.meta.data.with_spaces', // semver
                1, // major
                2, // minor
                0, // patch
                null, // pre_release
                'sha:value.meta.data.with_spaces', // meta
            ],
        ];
    }
}
