<?php
namespace Anax\View;

$mailChimpSubscribersUrl = url("admin/mailchimp/listsubscribers");
$mailChimpUrl = url("admin/mailchimp");
$route = $this->di->get("request")->getRoute();
?>
<ul class="nav nav-pills nav-justified">
    <li<?= $route === "admin/mailchimp" ? ' class="active"' : ""?>>
        <a href="<?= $mailChimpUrl ?>">MailChimp Configuration</a>
    </li>
    <li<?= $route === "admin/mailchimp/listsubscribers" ? ' class="active"' : ""?>>
        <a href="<?= $mailChimpSubscribersUrl ?>">Subscribers</a>
    </li>
</ul>
