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

        <?php if ($this->regionHasContent("header")) : ?>
        <div class="header">
            <div class="row-fluid">
                <div class="header">
                    <?php $this->renderRegion("header") ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="container-fluid">
            <div class="row-fluid">
            <?php if ($this->regionHasContent("main")) : ?>
                <main class="span9 main">
                    <?php $this->renderRegion("main") ?>
                    <?php if ($this->regionHasContent("main")) : ?>
                        <?php $this->renderRegion("comments") ?>
                    <?php endif; ?>
                </main>
            <?php endif; ?>

            <?php if ($this->regionHasContent("sidebar-right")) : ?>
                <div class="span3 sidebar-right">
                    <?php $this->renderRegion("main") ?>
                    <?php if ($this->regionHasContent("main")) : ?>
                        <?php $this->renderRegion("comments") ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            </div>


            <?php if ($this->regionHasContent("footer")) : ?>
            <div class="row-fluid">
                <div class="footer">
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
