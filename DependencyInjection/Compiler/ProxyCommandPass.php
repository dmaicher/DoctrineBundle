<?php

namespace Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler;

use Doctrine\Bundle\DoctrineBundle\Command\Proxy\ConnectionProviderAdapter;
use Doctrine\DBAL\Tools\Console\ConnectionProvider;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ProxyCommandPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!interface_exists(ConnectionProvider::class)) {
            return;
        }

        $container->register('doctrine.dbal.command.connection_provider', ConnectionProviderAdapter::class)
            ->addArgument(new Reference('doctrine'))
        ;

        $container->getDefinition('doctrine.query_sql_command')
            ->addArgument(new Reference('doctrine.dbal.command.connection_provider'));
    }
}
