Yii2 PSR3 Logging Adapter
=========================

Simple adapter class that allow third party components use fully PSR-3 compatible adapter.

Note that Yii2 has a limited number of logging levels so this class will
attempt to use the closest Yii2 equivalent for the provided PSR3 level.

Installation
------------

```
composer require aotd/yii2-psr3-component dev-master
```

Usage
-----

```php
  'components' => array(
     'psr3log' => array(
         'class' => 'aotd\\PSR3LogAdapter\\Logger',
     ),
  ),
```

and use it somewhere in your code:
```php
$foo = newSomeClassThatNeedsPsr3(Yii::$app->psr3log);
```

Optionally you can remap log levels between PSR-3 and Yii:

```php
  'components' => [
     'psr3log' => [
         'class' => 'aotd\\PSR3LogAdapter\\Logger',
         'logLevelMap' => [
             'emergency' => YiiLogger::LEVEL_ERROR,
             'alert' => YiiLogger::LEVEL_ERROR,
             'critical' => YiiLogger::LEVEL_ERROR,
             'error' => YiiLogger::LEVEL_ERROR,
             'warning' => YiiLogger::LEVEL_WARNING,
             'notice' => YiiLogger::LEVEL_INFO,
             'info' => YiiLogger::LEVEL_INFO,
             'debug' => YiiLogger::LEVEL_TRACE,
         ],
     ],
  ],
```
