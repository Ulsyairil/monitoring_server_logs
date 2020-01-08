<?php

require(__DIR__ . "/vendor/autoload.php");

use splitbrain\phpcli\CLI;
use splitbrain\phpcli\Options;

class Monitoring extends CLI
{
    protected function setup(Options $options)
    {
        $options->setHelp("Simple CLI for monitoring server log");
        $options->registerOption("version", "Show version", "v");
        $options->registerOption("migrate", "Migrate table", "m");
        $options->registerOption("drop", "Drop table", "d");
    }

    protected function main(Options $options)
    {
        if ($options->getOpt('version')) {
            $this->info("0.0.1-alpha");
        } elseif ($options->getOpt('migrate')) {
            include_once(__DIR__ . "/cli/migrate.php");
            $this->info("Success migrate table");
        } elseif ($options->getOpt('drop')) {
            include_once(__DIR__ . "/cli/drop.php");
            $this->info("Success drop table");
        } else {
            echo $options->help();
        }
    }
}

$cli = new Monitoring();
$cli->run();
