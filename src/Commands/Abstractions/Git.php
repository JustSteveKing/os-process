<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\OS\Commands\Abstractions;

use JustSteveKing\Laravel\OS\Commands\Types\Git as SubCommand;
use JustSteveKing\Laravel\OS\Concerns\HandlesGitCommands;
use JustSteveKing\Laravel\OS\Contracts\CommandContract;
use JustSteveKing\Laravel\OS\Contracts\ProcessContract;
use Symfony\Component\Process\Process;

final class Git implements ProcessContract
{
    use HandlesGitCommands;

    private CommandContract $command;

    public function push(string $branch): Process
    {
        $this->buildCommand(
            type: SubCommand::PUSH,
            args: [
                'origin',
                $branch,
            ],
        );

        return $this->build();
    }

    public function status(): Process
    {
        $this->buildCommand(
            type: SubCommand::STATUS,
        );

        return $this->build();
    }
}
