<?php

declare(strict_types=1);

use JustSteveKing\Laravel\OS\Commands\Abstractions\Git;

it('can execute a git command', function () {
    $git = new Git();

    $git->status()->run(
        callback: function ($type, $buffer) {
            expect($buffer)
                ->toBeString()
                ->toContain(
                    'On branch main',
                );
        },
    );
});
