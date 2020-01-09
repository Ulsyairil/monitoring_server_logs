<?php

require(__DIR__ . "/vendor/autoload.php");
require(__DIR__ . "/cli/access.php");

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
        $options->registerOption("save_access", "Save access log to database and delete access log");
        $options->registerOption("show_access", "Show access log on real time");
    }

    protected function main(Options $options)
    {
        if ($options->getOpt('version')) {
            $this->info("0.0.1-alpha");
        } elseif ($options->getOpt('migrate')) {
            try {
                include_once(__DIR__ . "/database/mysql/create.php");
                $this->info("Success create table");
            } catch (\Exception $error) {
                $this->info($error->getMessage());
            }
        } elseif ($options->getOpt('drop')) {
            try {
                include_once(__DIR__ . "/database/mysql/drop.php");
                $this->info("Success drop table");
            } catch (\Exception $error) {
                $this->info($error->getMessage());
            }
        } elseif ($options->getOpt('save_access')) {
            try {
                $info = CLIAccessLog::create();
                $this->info($info);
            } catch (\Exception $error) {
                $this->info($error->getMessage());
            }
        } elseif ($options->getOpt('show_access')) {
            try {
                $info = CLIAccessLog::show();
                $this->info($info);
            } catch (\Exception $error) {
                $this->info($error->getMessage());
            }
        } else {
            echo $options->help();
        }
    }
}

$cli = new Monitoring();
$cli->run();
