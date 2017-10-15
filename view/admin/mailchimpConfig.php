<?php
namespace Anax\View;

$apiKey = isset($apiKey) ? htmlspecialchars($apiKey) : "-";
$endpointUrl = isset($endpointUrl) ? htmlspecialchars($endpointUrl) : "-";
$defaultListName = isset($defaultList->name) ? htmlspecialchars($defaultList->name) : "-";
$defaultListId = isset($defaultList->id) ? htmlspecialchars($defaultList->id) : "-";

$logoutUrl = url("user/logout");
?>
<h1>MailChimp Configuration</h1>
<div class="row">
    <div class="col-md-12 col-xs-12">
        <ul class="list-group col-md-6 col-xs-12">
            <li class="list-group-item"><strong>ApiKey: </strong><?= $apiKey ?></li>
            <li class="list-group-item"><strong>Endpoint url: </strong><?= $endpointUrl ?></li>
            <li class="list-group-item"><strong>Default list: </strong><?= $defaultListName ?> (<?= $defaultListId ?>)</li>
        </ul>
    </div>
    <div class="col-md-12 col-xs-12">
        <?= $form ?>
    </div>
</div>
