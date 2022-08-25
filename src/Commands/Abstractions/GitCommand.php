<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\OS\Commands\Abstractions;

use JustSteveKing\Laravel\OS\Commands\Types\Git as SubCommand;
use JustSteveKing\Laravel\OS\Contracts\CommandContract;
use Symfony\Component\Process\ExecutableFinder;
use Throwable;

final class GitCommand implements CommandContract
{
    /**
     * @param SubCommand $type
     * @param array $args
     */
    public function __construct(
        private readonly SubCommand $type,
        private readonly array $args = [],
    ) {}

    /**
     * @return array
     * @throws Throwable
     */
    public function toArgs(): array
    {
        try {
            $executable = (new ExecutableFinder())->find(
                name: 'git',
            );
        } catch (Throwable $exception) {
            throw $exception;
        }

        return array_merge(
            [$executable],
            [$this->type->value],
            $this->args,
        );
    }
}
