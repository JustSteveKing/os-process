<?php

declare(strict_types=1);

namespace JustSteveKing\Laravel\OS\Contracts;

interface CommandContract
{
    /**
     * Return the Command as an array of arguments for Symfony Process
     *
     * @return array
     */
    public function toArgs(): array;
}
