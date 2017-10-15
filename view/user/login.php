<?php

namespace Anax\View;

$items = isset($items) ? $items : null;
$urlToCreate = url("user/create");
?>
<h1>Administration</h1>

<?= $form ?>
