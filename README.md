# jie-anthony/eloquent-filter-in-hyperf

### 安装
```
composer require jie-anthony/eloquent-filter-in-hyperf -vvv
```
### 发布配置
```
php bin/hyperf.php vendor:publish jie-anthony/eloquent-filter-in-hyperf
```

## 命令行创建文件

```
php bin/hyperf.php gen:eloquent-filter UserFilter
```


## Filter文件
```
<?php

declare (strict_types=1);
namespace App\ModelFilters;

use JieAnthony\EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
{
    public function name($name)
    {
        return $this->where('name', 'LIKE', "$name%");
    }

    public function age($age)
    {
        return $this->where('age', $age);
    }
}
```

## 模型
```
<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
use JieAnthony\EloquentFilter\Filterable;

class User extends Model
{
    use Filterable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';


    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\UserFilter::class);
    }
}
```

## 查询
```
<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use App\Model\User;
use Hyperf\HttpServer\Annotation\AutoController;

/**
 * @AutoController()
 */
class IndexController extends AbstractController
{

    public function test()
    {
        $params = $this->request->all();
        $data = User::filter($params)->get();
        return [
            'params' => $params,
            'data' => $data
        ];
    }
}

```
