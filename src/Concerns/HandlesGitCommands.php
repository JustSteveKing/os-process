<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\OS\Concerns;

use JustSteveKing\Laravel\OS\Commands\Abstractions\GitCommand;
use JustSteveKing\Laravel\OS\Commands\Types\Git;
use JustSteveKing\Laravel\OS\Contracts\ProcessContract;
use Symfony\Component\Process\Process;

/**
 * @mixin ProcessContract
 */
trait HandlesGitCommands
{
    /**
     * Build and return a new Symfony Process.
     *
     * @return Process
     */
    public function build(): Process
    {
        return new Process(
            command: $this->command->toArgs(),
        );
    }

    /**
     * Build a GitCommand and set it to the active command.
     *
     * @param Git $type
     * @param array $args
     * @return void
     */
    protected function buildCommand(Git $type, array $args = []): void
    {
        $this->command = new GitCommand(
            type: $type,
            args: $args,
        );
    }
}
