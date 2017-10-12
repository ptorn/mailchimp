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
        <div class="navbar">
            <div class="row-fluid">
                <div class="top-navbar">
                    <?php $this->renderRegion("navbar") ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="container">
            <?php if ($this->regionHasContent("header")) : ?>
            <div class="header">
                <div class="row-fluid">
                    <div class="header">
                        <?php $this->renderRegion("header") ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($this->regionHasContent("main")) : ?>
            <div class="main">
                <div class="row-fluid">
                    <main class="main">
                        <?php $this->renderRegion("main") ?>
                        <?php if ($this->regionHasContent("main")) : ?>
                            <?php $this->renderRegion("comments") ?>
                        <?php endif; ?>
                    </main>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($this->regionHasContent("footer")) : ?>
            <div class="footer">
                <div class="row-fluid">
                    <div class="center-block text-center">
                        <div class="block site-footer">
                            <?php $this->renderRegion("footer") ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>


        <?php foreach ($javascripts as $javascript) : ?>
            <script src="<?= $this->asset($javascript) ?>"></script>
        <?php endforeach; ?>


    </body>
</html>
