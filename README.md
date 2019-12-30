# anthony/hyperf-filter

### 安装
```
composer create-project jie-anthony/hyperf-filter -vvv
```
### 发布配置
```
php bin/hyperf.php vendor:publish jie-anthony/hyperf-filter
```
## 新建文件夹 app/ModelFilters


## Filter文件
```
<?php

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

## 模型中的使用
```
<?php

declare (strict_types=1);
namespace App\Model;

use Hyperf\DbConnection\Model\Model;
use JieAnthony\EloquentFilter\Filterable;
/**
 */
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

## TODO
- 命令行新建Filter文件