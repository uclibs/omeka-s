<?php

declare(strict_types=1);

namespace Laminas\Log\Writer;

use Laminas\Log\Exception;
use Laminas\Log\Logger;
use Psr\Log\LoggerAwareTrait as PsrLoggerAwareTrait;
use Psr\Log\LoggerInterface as PsrLoggerInterface;
use Psr\Log\LogLevel;
use Psr\Log\NullLogger;
use Traversable;

use function is_array;
use function iterator_to_array;

/**
 * Proxies log messages to an existing PSR-3 compliant logger.
 */
class Psr extends AbstractWriter
{
    use PsrLoggerAwareTrait;

    /**
     * Map priority to PSR-3 LogLevels
     *
     * @var int[]
     */
    protected $psrPriorityMap = [
        Logger::EMERG  => LogLevel::EMERGENCY,
        Logger::ALERT  => LogLevel::ALERT,
        Logger::CRIT   => LogLevel::CRITICAL,
        Logger::ERR    => LogLevel::ERROR,
        Logger::WARN   => LogLevel::WARNING,
        Logger::NOTICE => LogLevel::NOTICE,
        Logger::INFO   => LogLevel::INFO,
        Logger::DEBUG  => LogLevel::DEBUG,
    ];

    /**
     * Default log level (warning)
     *
     * @var int
     */
    protected $defaultLogLevel = LogLevel::WARNING;

    /**
     * Constructor
     *
     * Set options for a writer. Accepted options are:
     *
     * - filters: array of filters to add to this filter
     * - formatter: formatter for this writer
     * - logger: PsrLoggerInterface implementation
     *
     * @param  array|Traversable|PsrLoggerInterface $options
     * @throws Exception\InvalidArgumentException
     */
    public function __construct($options = null)
    {
        if ($options instanceof PsrLoggerInterface) {
            $this->setLogger($options);
        }

        if ($options instanceof Traversable) {
            $options = iterator_to_array($options);
        }

        if (is_array($options) && isset($options['logger'])) {
            $this->setLogger($options['logger']);
        }

        parent::__construct($options);

        if (null === $this->logger) {
            $this->setLogger(new NullLogger());
        }
    }

    /**
     * Write a message to the PSR-3 compliant logger.
     *
     * @param array $event event data
     * @return void
     */
    protected function doWrite(array $event)
    {
        $priority = $event['priority'];
        $message  = $event['message'];
        $context  = $event['extra'];

        $level = $this->psrPriorityMap[$priority] ?? $this->defaultLogLevel;

        $this->logger->log($level, $message, $context);
    }
}
