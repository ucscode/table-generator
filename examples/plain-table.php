<?php

use Ucscode\HtmlComponent\TableGenerator\Adapter\SampleAdapter;
use Ucscode\HtmlComponent\TableGenerator\TableGenerator;

require '../vendor/autoload.php';
require './Adapter/SampleAdapter.php';

$adapter = new SampleAdapter('sample.json');
$tableGenerator = new TableGenerator($adapter);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Table Generator | Plain Sample</title>
    </head>
    <body>
        <h3>Plain Table Example</h3>
        <div>
            <?php echo $tableGenerator->render(0); ?>
        </div>
    </body>
</html>