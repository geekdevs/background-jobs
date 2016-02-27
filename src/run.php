<?php
require '../vendor/autoload.php';

use mikehaertl\shellcommand\Command;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('processes');
$logFile = '../logs/processes.log';
$logger->pushHandler(new StreamHandler($logFile));

$manager = new Spork\ProcessManager();

for ($i=1; $i<=4; ++$i) {
    $manager->fork(function () use ($logger, $i) {
        $command = "php long-running-job.php $i";
        $context = ['command' => $command];

        $logger->debug("FORK $i started", $context);

        $cmd = new Command($command);
        $cmd->execute();

        $output = $cmd->getOutput();
        if ($output) {
            $logger->info($output, $context);
        }

        $error = $cmd->getError();
        if ($error) {
            $logger->error($error, $context);
        }

        $logger->debug('Exit Code: ' . $cmd->getExitCode(), $context);
    });
}

$manager->wait();
echo "Finished! See $logFile for output\n";