<?php

declare(strict_types=1);

namespace JustSteveKing\OS\Commands\Types;

enum Git: string
{
    /**
     * SET UP
     */
    case CONFIG = 'config'; // 'user.name', 'user.email', '--global'

    /**
     * SET UP & INIT
     */
    case INIT = 'init';
    case CLONE = 'clone'; // 'url'

    /**
     * STAGE & SNAPSHOT
     */
    case STATUS = 'status';
    case ADD = 'add'; // 'file'
    case RESET = 'reset'; // 'file', '--hard [commit]'
    case DIFF = 'diff'; // '--staged'
    case COMMIT = 'commit'; // '-m "descriptive message"'

    /**
     * BRANCH & MERGE
     */
    case BRANCH = 'branch'; // 'branch-name'
    case CHECKOUT = 'checkout';
    case MERGE = 'merge'; // 'branch'
    case LOG = 'log'; // 'branch..branch', '--follow' file

    /**
     * SHARE & UPDATE
     */
    case REMOTE = 'remote'; // 'add', 'alias', 'url'
    case FETCH = 'fetch'; // 'alias'
    case PULL = 'pull';
    case PUSH = 'push'; // 'alias', 'branch'
    case REBASE = 'rebase'; // 'branch'

    /**
     * Temporary
     */
    case STASH = 'stash'; // 'list', 'pop', 'drop'
}
