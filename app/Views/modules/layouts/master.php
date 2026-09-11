<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>
        Admin Panel - 
        <?= $this->renderSection("title") ?>
    </title>

    <!-- CSS -->
    <?= view("modules/layouts/components/style-css") ?>
    <!-- End CSS -->

</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>

            <!-- Navbar -->
            <?= view("modules/layouts/components/navbar") ?>
            <!-- End Navbar -->

            <!-- Sidebar -->
            <?= view("modules/layouts/components/sidebar") ?>
            <!-- End Sidebar -->

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <?= $this->renderSection("title-page") ?>
                    </div>

                    <div class="section-body">
                        <?= $this->renderSection("content") ?>
                    </div>
                </section>
            </div>
            <!-- End Main Content -->

            <!-- Footer -->
            <?=  view("modules/layouts/components/footer") ?>
            <!-- End Footer -->

        </div>
    </div>

    <!-- JS -->
    <?= view("modules/layouts/components/style-js") ?>
    <!-- End JS -->
     
</body>

</html>