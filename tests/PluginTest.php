<?php
declare(strict_types=1);

namespace Webcoders\Composer\SvnExportPlugin\Test;

use Composer\Composer;
use Composer\Config;
use Composer\Downloader\DownloadManager;
use Composer\IO\NullIO;
use Webcoders\Composer\SvnExportPlugin\Downloader\SvnExportDownloader;
use Webcoders\Composer\SvnExportPlugin\SvnExportPlugin;
use PHPUnit\Framework\TestCase;

class PluginTest extends TestCase
{
    public function testPluginRegistersSvnExportDownloader(): void
    {
        $io = new NullIO();
        $composer = new Composer();
        $composer->setConfig(new Config());
        $composer->setDownloadManager(new DownloadManager($io));

        $plugin = new SvnExportPlugin();
        $plugin->activate($composer, $io);

        $downloader = $composer->getDownloadManager()->getDownloader('svn');
        $this->assertInstanceOf(SvnExportDownloader::class, $downloader);
    }
}
