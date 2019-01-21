<?php
/**
 *
 *
 *
 */

namespace php\practice\DependencyInjection09;


class DatabaseConnection
{
    /**
     * @var DatabaseConfiguration
     */
    private $configuration;

    public function __construct(DatabaseConfiguration $config)
    {
        $this->configuration = $config;
    }

    public function getDsn(): string
    {
       return sprintf(
           '%s:%s@%s:%d',
           $this->configuration->getUserName(),
           $this->configuration->getPassWord(),
           $this->configuration->getHost(),
           $this->configuration->getPort()
       );
    }
}