<?php
$routes = $di->get("navbar")->routes();
?>
<div class="site-logo-text">
    Webshop
</div>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Webshop</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <?php foreach ($routes as $route) : ?>
            <li class="<?= $di->get("navbar")->isActiveLink($route) ? "active" : "" ?> nav-item">
                <a
                    href="<?= $route['url'] ?>"
                    title="<?= $route['title'] ?>"
                    class="<?= $di->get("navbar")->isActiveLink($route) ? "active" : "" ?> nav-link"
                >
                <?= $route['title'] ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
