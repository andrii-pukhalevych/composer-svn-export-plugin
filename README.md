# composer-svn-export-plugin
Configures composer to use `svn export` when retrieving packages from svn repositories (which is much faster than a full checkout).

## How it works
The SvnExportDownloader extends the normal composer SvnDownloader. This means that you do not have to change your composer.json to use it.
