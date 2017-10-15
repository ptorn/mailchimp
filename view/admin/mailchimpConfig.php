<?php
namespace Anax\View;

$apiKey = isset($apiKey) ? htmlspecialchars($apiKey) : "-";
$endpointUrl = isset($endpointUrl) ? htmlspecialchars($endpointUrl) : "-";
$defaultListName = isset($defaultList->name) ? htmlspecialchars($defaultList->name) : "-";
$defaultListId = isset($defaultList->id) ? htmlspecialchars($defaultList->id) : "-";

// var_dump($defaultList);
$logoutUrl = url("user/logout");
?>
<h1>MailChimp Configuration</h1>
<ul class="list-group">
    <li class="list-group-item"><strong>ApiKey: </strong><?= $apiKey ?></li>
    <li class="list-group-item"><strong>Endpoint url: </strong><?= $endpointUrl ?></li>
    <li class="list-group-item"><strong>Default list: </strong><?= $defaultListName ?> (<?= $defaultListId ?>)</li>
</ul>
<?= $form ?>
