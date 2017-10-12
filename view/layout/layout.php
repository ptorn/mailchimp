<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?></title>
        <?php foreach ($stylesheets as $stylesheet) : ?>
            <link rel="stylesheet" type="text/css" href="<?= $this->asset($stylesheet) ?>">
        <?php endforeach; ?>
    </head>
    <body>
        <?php if ($this->regionHasContent("navbar")) : ?>
        <div class="outer-wrap outer-wrap-navbar">
            <div class="inner-wrap inner-wrap-navbar">
                <div class="row">
                    <div class="top-navbar">
                        <?php $this->renderRegion("navbar") ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="wrap-all">
            <?php if ($this->regionHasContent("header")) : ?>
            <div class="outer-wrap outer-wrap-header">
                <div class="inner-wrap inner-wrap-header">
                    <div class="row">
                        <div class="header">
                            <?php $this->renderRegion("header") ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($this->regionHasContent("main")) : ?>
            <div class="outer-wrap outer-wrap-main">
                <div class="inner-wrap inner-wrap-main">
                    <div class="row">
                        <main class="main">
                            <?php $this->renderRegion("main") ?>
                            <?php if ($this->regionHasContent("main")) : ?>
                                <?php $this->renderRegion("comments") ?>
                            <?php endif; ?>
                        </main>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($this->regionHasContent("footer")) : ?>
            <div class="outer-wrap outer-wrap-footer">
                <div class="inner-wrap inner-wrap-footer">
                    <div class="row">
                        <div class="footer">
                            <div class="block site-footer">
                                <?php $this->renderRegion("footer") ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <script src="<?= $app->url->asset('js/menu.js'); ?>"></script>




    </body>
</html>
