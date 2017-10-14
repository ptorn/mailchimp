<?php
namespace Anax\View;

$apiKey = isset($apiKey) ? htmlspecialchars($apiKey) : "-";
$endpointUrl = isset($endpointUrl) ? htmlspecialchars($endpointUrl) : "-";
$defaultList = isset($defaultList) ? htmlspecialchars($defaultList) : "-";

$logoutUrl = url("user/logout");
?>
<h1>MailChimp Configuration</h1>

<p>ApiKey: <?= $apiKey ?></p>
<p>Endpoint Url: <?= $endpointUrl ?></p>
<p>Default list id: <?= $defaultList ?></p>


<?= $form ?>
