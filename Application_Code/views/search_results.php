<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
</style>
</head>
<body>
<div>
    <?php
       
        foreach ($results as $val)
        {
            echo $val['document_name'];
            echo $val['author'];
            echo $val['tag1'];
            echo $val['reviewer1'];
            echo $val['reviewer2'];
            echo $val['reviewer3'];
            echo $val['score'];
        }
    ?>
</div>
</body>
</html>
