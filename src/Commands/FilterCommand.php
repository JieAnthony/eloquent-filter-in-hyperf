<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace JieAnthony\EloquentFilter\Commands;

use Hyperf\Command\Annotation\Command;
use Hyperf\Devtool\Generator\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @Command
 */
class FilterCommand extends GeneratorCommand
{
    protected $name = 'gen:eloquent-filter';

    public function __construct()
    {
        parent::__construct($this->name);
        $this->setDescription('Create a new model filter class');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;

        $inputs = $this->getNameInput();
        $name = $this->qualifyClass($inputs['name']);

        $path = $this->getPath($name);

        if (($input->getOption('force') === false) && $this->alreadyExists($inputs['name'])) {
            $output->writeln(sprintf('<fg=red>%s</>', $name . ' already exists!'));
            return false;
        }
        $this->makeDirectory($path);
        file_put_contents($path, $this->buildModelFilterClass($name));
        $output->writeln(sprintf('<info>%s</info>', $name . ' created successfully.'));
    }

    protected function buildModelFilterClass($name)
    {
        $stub = file_get_contents($this->getStub());
        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    protected function getStub(): string
    {
        return __DIR__ . '/stubs/modelfilter.stub';
    }

    protected function getDefaultNamespace(): string
    {
        return $this->getConfig()['namespace'] ?? 'App\\ModelFilters';
    }

    /**
     * Get the desired class name from the input.
     *
     * @return array
     */
    protected function getNameInput()
    {
        return [
            'name' => trim($this->input->getArgument('name')),
        ];
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the model filter class'],
        ];
    }
}
