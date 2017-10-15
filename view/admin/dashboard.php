<?php
namespace Anax\View;

$items = isset($users) ? $users : null;
$editUrl = url("user/update/$user->id");
$logoutUrl = url("user/logout");
$mailChimpUrl = url("admin/mailchimp");
?>
<h1>Welcome to the Dashboard</h1>


<p>Du är inloggad som <?= $user->firstname . " " . $user->lastname ; ?></p>

<div class="row">
    <div class="col-md-2 col-xs-12">
        <img src="<?= $gravatarUrl; ?>">
    </div>
    <div class="col-md-10 col-xs-12">
        <ul class="list-group col-md-5">
            <li class="list-group-item"><strong>Förnamn: </strong><?= $user->firstname; ?></li>
            <li class="list-group-item"><strong>Efternamn: </strong><?= $user->lastname; ?></li>
            <li class="list-group-item"><strong>Epost: </strong><?= $user->email; ?></li>
            <li class="list-group-item"><strong>Aktiverad: </strong><?= $user->enabled; ?></li>
            <li class="list-group-item"><strong>Administrator: </strong><?= $user->administrator; ?></li>
        </ul>
    </div>
</div>
<a href="<?= $editUrl ?>">Uppdatera</a> | <a href="<?= $logoutUrl ?>">Logga Ut</a>
