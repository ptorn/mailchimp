<?php
namespace Anax\View;

$endUrl = isset($apiKey) ? htmlspecialchars($endpointUrl) : "-";
$apiKey = isset($apiKey) ? htmlspecialchars($apiKey) : "-";
$defaultListName = isset($defaultList->name) ? htmlspecialchars($defaultList->name) : "-";
$mailList = isset($defaultList->id) ? htmlspecialchars($defaultList->name) . " (" . htmlspecialchars($defaultList->id) . ")" : "-";

$logoutUrl = url("user/logout");
?>
<h1>MailChimp Configuration</h1>
<div class="row">
    <div class="col-md-12 col-xs-12">
        <ul class="list-group col-md-6 col-xs-12">
            <li class="list-group-item"><strong>ApiKey: </strong><?= $apiKey ?></li>
            <li class="list-group-item"><strong>Endpoint url: </strong><?= $endUrl ?></li>
            <li class="list-group-item"><strong>Default list: </strong><?= $mailList ?></li>
        </ul>
    </div>
    <div class="col-md-12 col-xs-12">
        <?= $form ?>
    </div>
</div>
