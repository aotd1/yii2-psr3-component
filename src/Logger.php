<?php

namespace aotd\PSR3LogAdapter;

use yii\base\component;
use yii\log\Logger as YiiLogger;

/**
 * Class Logger
 * @package aotd\PSR3LogAdapter
 */
class Logger extends Component
{
    /**
     * @var string Yii category for the logged messages.
     */

    public $defaultCategory = 'PSR-3-log';

    public $logLevelMap = [
        'emergency' => YiiLogger::LEVEL_ERROR,
        'alert' => YiiLogger::LEVEL_ERROR,
        'critical' => YiiLogger::LEVEL_ERROR,
        'error' => YiiLogger::LEVEL_ERROR,
        'warning' => YiiLogger::LEVEL_WARNING,
        'notice' => YiiLogger::LEVEL_INFO,
        'info' => YiiLogger::LEVEL_INFO,
        'debug' => YiiLogger::LEVEL_TRACE,
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
        //@TODO: log somewhere other $context parameters
        $category = isset($context['category']) ? $context['category'] : $this->defaultCategory;
        \Yii::getLogger()->log($message, $this->logLevelMap[$level], $category);
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function emergency($message, array $context = [])
    {
        $this->log('emergency', $message, $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function alert($message, array $context = [])
    {
        $this->log('alert', $message, $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function critical($message, array $context = [])
    {
        $this->log('critical', $message, $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function error($message, array $context = [])
    {
        $this->log('error', $message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function warning($message, array $context = [])
    {
        $this->log('warning', $message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function notice($message, array $context = [])
    {
        $this->log('notice', $message, $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function info($message, array $context = [])
    {
        $this->log('info', $message, $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function debug($message, array $context = [])
    {
        $this->log('debug', $message, $context);
    }
}
