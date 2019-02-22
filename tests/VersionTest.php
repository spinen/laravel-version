<?php

namespace Spinen\Version;

class VersionTest extends TestCase
{
    /**
     * @test
     */
    public function it_parses_a_simple_version_file()
    {
        $this->version_file->setContent("1.2.0");

        $version = new Version($this->version_file->url());

        $this->assertEquals("1.2.0", (string)$version);
        $this->assertEquals("1.2.0", $version->version);
        $this->assertEquals("1.2.0", $version->semver);
        $this->assertEquals(1, $version->major);
        $this->assertEquals(2, $version->minor);
        $this->assertEquals(0, $version->patch);
        $this->assertNull($version->pre_release);
        $this->assertNull($version->meta);
    }

    /**
     * @test
     */
    public function it_parses_an_empty_version_file()
    {
        $this->version_file->setContent('');

        $version = new Version($this->version_file->url());

        $this->assertEquals("UNDEFINED", (string)$version);
        $this->assertEquals("UNDEFINED", $version->version);
        $this->assertEquals("UNDEFINED", $version->semver);
        $this->assertNull($version->major);
        $this->assertNull($version->minor);
        $this->assertNull($version->patch);
        $this->assertNull($version->pre_release);
        $this->assertNull($version->meta);
    }

    /**
     * @test
     */
    public function it_parses_a_version_file_with_invalid_format()
    {
        $this->version_file->setContent("a.b.c");

        $version = new Version($this->version_file->url());

        $this->assertEquals("UNDEFINED", (string)$version);
        $this->assertEquals("UNDEFINED", $version->version);
        $this->assertEquals("UNDEFINED", $version->semver);
        $this->assertNull($version->major);
        $this->assertNull($version->minor);
        $this->assertNull($version->patch);
        $this->assertNull($version->pre_release);
        $this->assertNull($version->meta);
    }

    /**
     * @test
     */
    public function it_parses_a_missing_version_file()
    {
        $this->root->removeChild("VERSION");

        $version = new Version($this->version_file->url());

        $this->assertEquals("UNDEFINED", (string)$version);
        $this->assertEquals("UNDEFINED", $version->version);
        $this->assertEquals("UNDEFINED", $version->semver);
        $this->assertNull($version->major);
        $this->assertNull($version->minor);
        $this->assertNull($version->patch);
        $this->assertNull($version->pre_release);
        $this->assertNull($version->meta);
    }

    /**
     * @test
     */
    public function it_parses_a_complex_version_file()
    {
        $this->version_file->setContent("1.2.0\n\nbranch\nsha:value\nmeta\ndata\nwith spaces");

        $version = new Version($this->version_file->url());

        $this->assertEquals("1.2.0-branch+sha:value.meta.data.with_spaces", (string)$version);
        $this->assertEquals("1.2.0", $version->version);
        $this->assertEquals("1.2.0-branch+sha:value.meta.data.with_spaces", $version->semver);
        $this->assertEquals(1, $version->major);
        $this->assertEquals(2, $version->minor);
        $this->assertEquals(0, $version->patch);
        $this->assertEquals("branch", $version->pre_release);
        $this->assertEquals("sha:value.meta.data.with_spaces", $version->meta);
    }

    /**
     * @test
     */
    public function it_parses_a_version_file_with_no_meta()
    {
        $this->version_file->setContent("1.2.0\n\nbranch");

        $version = new Version($this->version_file->url());

        $this->assertEquals("1.2.0-branch", (string)$version);
        $this->assertEquals("1.2.0", $version->version);
        $this->assertEquals("1.2.0-branch", $version->semver);
        $this->assertEquals(1, $version->major);
        $this->assertEquals(2, $version->minor);
        $this->assertEquals(0, $version->patch);
        $this->assertEquals("branch", $version->pre_release);
        $this->assertNull($version->meta);
    }

    /**
     * @test
     */
    public function it_parses_a_version_file_with_master_branch()
    {
        $this->version_file->setContent("1.2.0\n\nmaster");

        $version = new Version($this->version_file->url());

        $this->assertEquals("1.2.0", (string)$version);
        $this->assertEquals("1.2.0", $version->version);
        $this->assertEquals("1.2.0", $version->semver);
        $this->assertEquals(1, $version->major);
        $this->assertEquals(2, $version->minor);
        $this->assertEquals(0, $version->patch);
        $this->assertNull($version->pre_release);
        $this->assertNull($version->meta);
    }

    /**
     * @test
     */
    public function it_parses_a_complex_version_file_with_master_branch()
    {
        $this->version_file->setContent("1.2.0\n\nmaster\nsha:value\nmeta\ndata\nwith spaces");

        $version = new Version($this->version_file->url());

        $this->assertEquals("1.2.0+sha:value.meta.data.with_spaces", (string)$version);
        $this->assertEquals("1.2.0", $version->version);
        $this->assertEquals('1.2.0+sha:value.meta.data.with_spaces', $version->semver);
        $this->assertEquals(1, $version->major);
        $this->assertEquals(2, $version->minor);
        $this->assertEquals(0, $version->patch);
        $this->assertNull($version->pre_release);
        $this->assertEquals("sha:value.meta.data.with_spaces", $version->meta);
    }
}
