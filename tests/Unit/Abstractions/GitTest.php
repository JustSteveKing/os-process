<?php

declare(strict_types=1);

use JustSteveKing\Laravel\OS\Commands\Abstractions\Git;

it('can build a git push command', function (string $branch) {
    $git = new Git();

    $command = $git->push(
        branch: $branch,
    );

    expect(
        $command->getCommandLine(),
    )->toBeString()->toContain('push', 'origin', $branch);
})->with('branches');
