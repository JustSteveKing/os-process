<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\OS\Contracts;

use Symfony\Component\Process\Process;

/**
 * @property-read CommandContract $command
 */
interface ProcessContract
{
    /**
     * Build and return a Symfony Process.
     *
     * @return Process
     */
    public function build(): Process;
}
