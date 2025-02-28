<?php

use Ucscode\HtmlComponent\TableGenerator\Adapter\SampleAdapter;
use Ucscode\HtmlComponent\TableGenerator\TableGenerator;

require '../vendor/autoload.php';
require './Adapter/SampleAdapter.php';
require './Middleware/BootstrapDesignMiddleware.php';

$adapter = new SampleAdapter('sample.json');
$bootstrapMiddleware = new BootstrapDesignMiddleware();

$tableGenerator = new TableGenerator($adapter, $bootstrapMiddleware);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Table Generator | Bootstrap Sample</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <h3 class="mb-4">Bootstrap Table Example</h3>
        <div>
            <?php echo $tableGenerator->render(1); ?>
        </div>
    </body>
</html>