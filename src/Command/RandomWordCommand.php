<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RandomWordCommand extends Command
{
    protected static $defaultName = 'app:random-word';
    protected static string $defaultDescription = 'This command generates random word';

    protected function configure(): void
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('your-project', InputArgument::OPTIONAL, 'Your project')
            ->addOption('cap', null, InputOption::VALUE_NONE, 'Capitalize ?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $projectName = $input->getArgument('your-project');

        if ($projectName) {
            $io->note(sprintf('Your project will be %s', $projectName));
        }

        if ($input->getOption('cap')) {
            $projectName = strtoupper($projectName);
        }

        $io->success($projectName);

        return Command::SUCCESS;
    }
}
