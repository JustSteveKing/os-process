<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\OS\Concerns;

use JustSteveKing\Laravel\OS\Contracts\ProcessContract;
use Symfony\Component\Process\Process;

/**
 * @mixin ProcessContract
 */
trait HandlesGitCommands
{
    public function run(): Process
    {
        return new Process(
            command: $this->command->toArgs(),
        );
    }
}
