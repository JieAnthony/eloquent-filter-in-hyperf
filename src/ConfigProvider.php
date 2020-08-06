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
namespace JieAnthony\EloquentFilter;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
            ],
            'commands' => [
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'publish' => [
                [
                    'id' => 'eloquentfilter',
                    'description' => 'hyperf eloquent filter config file',
                    'source' => __DIR__ . '/../publish/eloquentfilter.php',
                    'destination' => BASE_PATH . '/config/autoload/eloquentfilter.php',
                ],
            ],
        ];
    }
}
