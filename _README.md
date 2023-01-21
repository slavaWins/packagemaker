<p align="center">
<img src="info/logo.jpg">
</p>
 
## PackageMaker
Кароч изи пакет 
   

## Установка из composer

```  
composer require slavawins/packagemaker
```

 Опубликовать js файлы, вью и миграции необходимые для работы пакета.
Вызывать команду:
```
php artisan vendor:publish --provider="PackageMaker\Providers\PackageMakerServiceProvider"
``` 

 В роутере routes/web.php удалить:
 добавить
 ```
    \PackageMaker\Library\PackageMakerRoute::routes();
 ```

Выполнить миграцию
 ```
    php artisan migrate 
 ``` 
