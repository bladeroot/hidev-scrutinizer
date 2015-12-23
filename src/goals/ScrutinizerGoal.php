<?php

/*
 * Scrutinizer plugin for HiDev
 *
 * @link      https://github.com/hiqdev/hidev-scrutinizer
 * @package   hidev-scrutinizer
 * @license   BSD-3-Clause
 * @copyright Copyright (c) 2015, HiQDev (http://hiqdev.com/)
 */

namespace hidev\scrutinizer\goals;

/**
 * Goal for Scrutinizer.
 */
class ScrutinizerGoal extends \hidev\goals\DefaultGoal
{
    public function actionUploadCoverage()
    {
        return $this->runActions(['wget-ocular', 'run-ocular']);
    }

    public function actionWgetOcular()
    {
        if (file_exists('ocular.phar')) {
            return 0;
        }

        return $this->passthru('wget', 'https://scrutinizer-ci.com/ocular.phar');
    }

    public function actionRunOcular()
    {
        return $this->passthru('ocular', ['code-coverage:upload', '--format=php-clover', 'coverage.clover']);
    }
}
