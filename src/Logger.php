<?php

namespace aotd\PSR3LogAdapter;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
use yii\base\component;
use yii\log\Logger as YiiLogger;

/**
 * Class Logger
 * @package aotd\PSR3LogAdapter
 */
class Logger extends Component implements LoggerInterface
{
    use LoggerTrait;

    /**
     * @var string Yii category for the logged messages.
     */

    public $defaultCategory = 'PSR-3-log';

    public $logLevelMap = [
        'emergency' => YiiLogger::LEVEL_ERROR,
        'alert'     => YiiLogger::LEVEL_ERROR,
        'critical'  => YiiLogger::LEVEL_ERROR,
        'error'     => YiiLogger::LEVEL_ERROR,
        'warning'   => YiiLogger::LEVEL_WARNING,
        'notice'    => YiiLogger::LEVEL_INFO,
        'info'      => YiiLogger::LEVEL_INFO,
        'debug'     => YiiLogger::LEVEL_TRACE,
    ];

    /**
     * Log a message, transforming from PSR3 log levels to the closest Yii2
     * equivalent.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     */
    public function log($level, $message, array $context = [])
    {
        /** @var \yii\log\Logger $logger */
        $logger = \Yii::getLogger();

        $category = isset($context['category']) ? $context['category'] : $this->defaultCategory;

        $message = $this->interpolate($message, $context);

        $logger->log($message, $this->logLevelMap[$level], $category);
    }

    private function interpolate($message, array $context = [])
    {
        $replace = [];
        foreach ($context as $key => $val) {
            if (!is_array($val) && (!is_object($val) || method_exists($val, '__toString'))) {
                $replace['{' . $key . '}'] = $val;
            }
        }

        return strtr($message, $replace);
    }
}
