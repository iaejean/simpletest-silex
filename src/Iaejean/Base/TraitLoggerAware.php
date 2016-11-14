<?php
declare(strict_types = 1);

namespace Iaejean\Base;

/**
 * Trait TraitLoggerAware
 * @package Iaejean\Base
 */
trait TraitLoggerAware
{
    /**
     * @var \Logger
     */
    private $logger;

    /**
     * @inheritdoc
     */
    public function setLogger(\Logger $logger)
    {
        $this->logger = $logger;
    }
}
