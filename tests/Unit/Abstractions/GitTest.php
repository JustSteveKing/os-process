<?php

declare(strict_types=1);

use JustSteveKing\OS\Commands\Abstractions\Git;
use JustSteveKing\OS\Commands\Abstractions\GitCommand;
use JustSteveKing\OS\Commands\Types\Git as SubCommand;

it('can build a git push command', function (string $branch) {
    $git = new Git();

    $command = $git->push(
        branch: $branch,
    );

    expect(
        $command->getCommandLine(),
    )->toBeString()->toContain('push', 'origin', $branch);
})->with('branches');

it('it throws an exception if the executable cannot be found', function () {
    $command = new GitCommand(
        type: SubCommand::ADD,
        args: [],
        executable: 'abcdefu',
    );

    $command->toArgs();
})->throws(InvalidArgumentException::class);
