<?php

if (isset($_GET['page']) && $_GET['page']) {
    $page_path = PAGE_PATH . $_GET['page'] . '.php';
    if (file_exists($page_path)) {
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2  ml-n3 bg-dark text-white min-vh-100">
                    <?php include TEMPLATE_PATH . 'menu.php'; ?>
                </div>
                <div class="col-md-10">
                    <?php
                    include_once(PAGE_PATH . $_GET['page'] . '.php');
                    ?>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 mr-n3 ml-n3 bg-dark min-vh-100">
                    <?php include TEMPLATE_PATH . 'menu.php'; ?>
                </div>
                <div class="col-md-10 ml-md-3">
                    <?php
                    include_once(PAGE_PATH . '404.php');
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 mr-n3 ml-n3 bg-dark">
                <?php include TEMPLATE_PATH . 'menu.php'; ?>
            </div>
            <div class="col-md-10 ml-md-3">
                <?php
                include_once(PAGE_PATH . 'home.php');
                ?>
            </div>
        </div>
    </div>
    <?php
}


