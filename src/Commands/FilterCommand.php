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

/**
 * @Command
 */
class FilterCommand extends GeneratorCommand
{
    public function __construct()
    {
        parent::__construct('gen:eloquent-filter');
        $this->setDescription('Create a new model filter class');
    }

    protected function getStub(): string
    {
        return __DIR__ . '/stubs/modelfilter.stub';
    }

    protected function getDefaultNamespace(): string
    {
        return config('eloquentfilter.namespace') ?? 'App\\ModelFilters';
    }
}
