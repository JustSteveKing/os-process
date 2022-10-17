# OS Process

This package is a wrapper around the Symfony Process component, and build up an API that is object-oriented
and user-friendly.

## Installation

```bash
composer require juststeveking/os-process
```

## Usage

To start using this package, you first need to create an Abstraction for the process you want to use. I will walk you through this here:

We create an abstraction for Terraform:

```php
use JustSteveKing\OS\Contracts\ProcessContract;

class Terraform implements ProcessContract
{
    //
}
```

The `ProcessContract` means that you have to implement a `build` method that will return a built Symfony Process that we can then run.

```php
use JustSteveKing\OS\Contracts\CommandContract;
use JustSteveKing\OS\Contracts\ProcessContract;
use Symfony\Component\Process\Process;

class Terraform implements ProcessContract
{
    private CommandContract $command;
    
    public function build() : Process
    {
        return new Process(
            command: $this->command->toArgs(),
        );
    }
}
```

Let's create a Command now:

```php
use JustSteveKing\OS\Contracts\CommandContract;

class TerraformCommand implements CommandContract
{
    public function __construct(
        public readonly array $args = [],
        public readonly null|string $executable = null,
    ) {}
    
    public function toArgs() : array
    {
        $executable = (new ExecutableFinder())->find(
            name: $this->executable ?? 'terraform',
        );

        if (null === $executable) {
            throw new InvalidArgumentException(
                message: "Cannot find executable for [$this->executable].",
            );
        }

        return array_merge(
            [$executable],
            $this->args,
        );
    }
}
```

Now we just need to build and assign this within our abstraction:

```php
use JustSteveKing\OS\Contracts\CommandContract;
use JustSteveKing\OS\Contracts\ProcessContract;
use Symfony\Component\Process\Process;

class Terraform implements ProcessContract
{
    private CommandContract $command;
    
    public function apply(): Process
    {
        $this->command = new TerraformCommand(
            executable: 'terraform',
        );
        
        return $this->build();
    }
    
    public function build() : Process
    {
        return new Process(
            command: $this->command->toArgs(),
        );
    }
}
```

Now we are able to work with this process in our code:

```php
$terraform = new Terraform();

$terraform->apply()->run(); // Will run `terraform apply` in an OS process.
```

You can also obtain information about the process


```php
$terraform = new Terraform();

$process = $terraform->apply(); // The process variable contains an instance of Symfony\Component\Process 

$process->run(); // run `terraform apply` in an OS process.

// Obtaining information about the process

$output = $process->getOutput(); // Output of the command
$error = $process->getErrorOutput(); // Error output
$commandLine = $process->getCommandLine(); // Obtaining the complete command
```

Getting real-time Process Output

```php
$terraform = new Terraform();

$process = $terraform->apply(); // The process variable contains an instance of Symfony\Component\Process 

$process->start(); // start `terraform apply` in an OS process. (start not run)

 $process->wait(function ($type, $buffer) {
        if (\Symfony\Component\Process\Process::ERR === $type) {
            echo 'ERR > '.$buffer;
        } else {
            echo 'OUT > '.$buffer;
        }
    });

```


