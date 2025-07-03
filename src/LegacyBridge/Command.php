<?php

declare(strict_types=1);

namespace App\LegacyBridge;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Exception\CommandNotFoundException;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

#[AsCommand(name: 'app:legacy')]
final readonly class Command
{
    public function __construct(
        #[Autowire('%legacy_cli_path%')] private string $legacyScriptPath,
        #[Autowire('@legacy.services')] private ContainerInterface $container
    ) {}

    public function __invoke(
        #[Argument(name: 'script')] string $scriptName,
        SymfonyStyle $io,
    ): int {
        $scriptPath = $this->legacyScriptPath.DIRECTORY_SEPARATOR.$scriptName;

        if (!is_readable($scriptPath)) {
            throw new CommandNotFoundException(sprintf(
                'Script at %s does not exist or is not readable.', $scriptPath
            ));
        }

        $io->info(sprintf('Running legacy command %s', $scriptPath));

        global $servicesForLegacy;
        $servicesForLegacy = $this->container;

        require_once $scriptPath;

        $io->newLine(2);
        $io->success('Done.');


        return \Symfony\Component\Console\Command\Command::SUCCESS;
    }
}
