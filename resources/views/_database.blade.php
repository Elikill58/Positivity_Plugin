<?php
$dbType = config("database.default");
config([
    'database.connections.positivity.driver' => 'mysql',
    'database.connections.positivity.host' => setting('positivity.host') ?? config("database.connections." . $dbType . ".host"),
    'database.connections.positivity.port' => setting('positivity.port') ?? config("database.connections." . $dbType . ".port"),
    'database.connections.positivity.username' => setting('positivity.username') ?? config("database.connections." . $dbType . ".username"),
    'database.connections.positivity.password' => setting('positivity.password') ?? config("database.connections." . $dbType . ".password"),
    'database.connections.positivity.database' => setting('positivity.database') ?? config("database.connections." . $dbType . ".database")
]);
?>