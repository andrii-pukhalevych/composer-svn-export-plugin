<?php
declare(strict_types=1);

namespace Webcoders\Composer\SvnExportPlugin;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Webcoders\Composer\SvnExportPlugin\Downloader\SvnExportDownloader;

class SvnExportPlugin implements PluginInterface
{

    public function activate(Composer $composer, IOInterface $io)
    {
        $composer->getDownloadManager()->setDownloader('svn', new SvnExportDownloader($io, $composer->getConfig()));
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {
        // No action required on deactivate for this plugin
    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
        // No action required on uninstall for this plugin
    }
}