<?php

declare(strict_types=1);

namespace JustSteveKing\OS\Commands\Abstractions;

use InvalidArgumentException;
use JustSteveKing\OS\Commands\Types\Git as SubCommand;
use JustSteveKing\OS\Contracts\CommandContract;
use Symfony\Component\Process\ExecutableFinder;

/**
 * @property-read SubCommand $type
 * @property-read array $args
 * @property-read null|string $executable
 */
final class GitCommand implements CommandContract
{
    /**
     * @param SubCommand $type
     * @param array $args
     * @param null|string $executable
     */
    public function __construct(
        public readonly SubCommand $type,
        public readonly array $args = [],
        public readonly null|string $executable = null,
    ) {
    }

    /**
     * @return array
     */
    public function toArgs(): array
    {
        $executable = (new ExecutableFinder())->find(
            name: $this->executable ?? 'git',
        );

        if (null === $executable) {
            throw new InvalidArgumentException(
                message: "Cannot find executable for [$this->executable].",
            );
        }

        return array_merge(
            [$executable],
            [$this->type->value],
            $this->args,
        );
    }
}
