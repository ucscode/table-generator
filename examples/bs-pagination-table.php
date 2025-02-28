<?php

use Ucscode\HtmlComponent\TableGenerator\Adapter\SampleAdapter;
use Ucscode\HtmlComponent\TableGenerator\TableGenerator;
use Ucscode\Paginator\Paginator;

require '../vendor/autoload.php';
require './Adapter/SampleAdapter.php';
require './Middleware/BootstrapDesignMiddleware.php';
require './Middleware/CheckboxMiddleware.php';

$paginator = new Paginator(
    0, // total number of items (will be updated by the adapter)
    3, // items to show per page
    $_GET['page'] ?? 1, // the current page
    '?page=' . Paginator::NUM_PLACEHOLDER // the url pattern to use for pagination
);

$adapter = new SampleAdapter('sample.json', $paginator);
$bootstrapMiddleware = new BootstrapDesignMiddleware();

$tableGenerator = new TableGenerator($adapter, [
    $bootstrapMiddleware,
]);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Table Generator | pagination Sample</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <h3 class="mb-4">Pagination Table Example</h3>
        <div>
            <?php echo $tableGenerator->render(1); ?>
            <?php echo $tableGenerator->getPaginator()->getBuilder()->render(1); ?>
        </div>
    </body>
</html>