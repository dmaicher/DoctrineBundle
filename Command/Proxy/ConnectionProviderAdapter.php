<?php

namespace Doctrine\Bundle\DoctrineBundle\Command\Proxy;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Tools\Console\ConnectionProvider;
use Symfony\Bridge\Doctrine\ManagerRegistry;

final class ConnectionProviderAdapter implements ConnectionProvider
{
    /** @var ManagerRegistry */
    private $registry;

    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function getDefaultConnection() : Connection
    {
        return $this->registry->getConnection();
    }

    public function getConnection(string $name) : Connection
    {
        return $this->registry->getConnection($name);
    }
}
