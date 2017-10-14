<?php
namespace Anax\View;

$items = isset($users) ? $users : null;
$editUrl = url("user/update/$user->id");
$logoutUrl = url("user/logout");
$mailChimpUrl = url("admin/mailchimp");
?>
<h1>Welcome to the Dashboard</h1>

<p>Du är inloggad som <?= $user->firstname . " " . $user->lastname ; ?></p>
<img src="<?= $gravatarUrl; ?>">
<div class="User-info">
    <span>Förnamn: </span><?= $user->firstname; ?><br>
    <span>Efternamn: </span><?= $user->lastname; ?><br>
    <span>Epost: </span><?= $user->email; ?><br>
    <span>Aktiverad: </span><?= $user->enabled; ?><br>
    <span>Administrator: </span><?= $user->administrator; ?>
</div>
<a href="<?= $editUrl ?>">Uppdatera</a> | <a href="<?= $logoutUrl ?>">Logga Ut</a>
