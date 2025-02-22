<?php

use Ucscode\HtmlComponent\TableGenerator\Adapter\SampleAdapter;
use Ucscode\HtmlComponent\TableGenerator\TableGenerator;

require '../vendor/autoload.php';
require './Adapter/SampleAdapter.php';
require './Middleware/BootstrapDesignMiddleware.php';
require './Middleware/CheckboxMiddleware.php';
require './Middleware/ActionsMiddleware.php';

$adapter = new SampleAdapter('sample.json');
$bootstrapMiddleware = new BootstrapDesignMiddleware();
$actionsMiddleware = new ActionsMiddleware();

$tableGenerator = new TableGenerator($adapter, [
    $bootstrapMiddleware,
    $actionsMiddleware,
]);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Table Generator | Actions Sample</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <h3 class="mb-4">Actions (Middleware) Table Example</h3>
        <div>
            <?php echo $tableGenerator->render(0); ?>
        </div>
    </body>
</html>