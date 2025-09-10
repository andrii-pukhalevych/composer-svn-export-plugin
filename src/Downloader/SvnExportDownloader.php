<?php
declare(strict_types=1);

namespace Webcoders\Composer\SvnExportPlugin\Downloader;

use Composer\Downloader\SvnDownloader;
use Composer\Package\PackageInterface;
use Composer\Repository\VcsRepository;
use Composer\Util\Svn as SvnUtil;
use React\Promise\PromiseInterface;

class SvnExportDownloader extends SvnDownloader
{

    /**
     * @inheritDoc
     */
    protected function doInstall(PackageInterface $package, string $path, string $url): PromiseInterface
    {
        SvnUtil::cleanEnv();
        $ref = $package->getSourceReference();

        $repo = $package->getRepository();
        if ($repo instanceof VcsRepository) {
            $repoConfig = $repo->getRepoConfig();
            if (array_key_exists('svn-cache-credentials', $repoConfig)) {
                $this->cacheCredentials = (bool)$repoConfig['svn-cache-credentials'];
            }
        }

        $this->io->writeError(" Exporting " . $ref);
        $this->execute($package, $url, ['svn', 'export', '--force'], sprintf("%s/%s", $url, $ref), null, $path);

        return \React\Promise\resolve(null);
    }

    /**
     * @inheritDoc
     */
    protected function doUpdate(PackageInterface $initial, PackageInterface $target, string $path, string $url): PromiseInterface
    {
        SvnUtil::cleanEnv();
        $ref = $target->getSourceReference();

        $this->io->writeError(" Exporting " . $ref);
        $this->execute($target, $url, ['svn', 'export', '--force'], sprintf("%s/%s", $url, $ref), null, $path);

        return \React\Promise\resolve(null);
    }
}