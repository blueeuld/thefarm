<?php

use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;

$logger = new Logger('defaultLogger');
$logger->pushHandler(new RotatingFileHandler(__DIR__.'/../logs/'.'propel.log', 5));

$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('default', 'mysql');
$serviceContainer->setLogger('defaultLogger', $logger);

$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'dsn' => 'mysql:host=localhost;port=3306;dbname=schedule',
  'user' => 'marvin',
  'password' => 'marvin',
  'settings' =>
  array (
    'charset' => 'utf8',
    'queries' =>
    array (
    ),
  ),
  'classname' => 'Propel\\Runtime\\Connection\\DebugPDO',
  'model_paths' =>
  array (
    0 => 'src',
    1 => 'vendor',
  ),
));
$manager->setName('default');
$serviceContainer->setConnectionManager('default', $manager);
$serviceContainer->setDefaultDatasource('default');

//$migrationCommand = new \Propel\Generator\Command\MigrationMigrateCommand();
//$arguments = [];
//$input = new \Symfony\Component\Console\Input\ArrayInput($arguments);
//
//$file   = __DIR__.'/../logs/'.'migration.log';
//$handle = fopen($file, 'w+');
//$output = new \Symfony\Component\Console\Output\StreamOutput($handle);
//
//$migrationCommand->run($input, $output);