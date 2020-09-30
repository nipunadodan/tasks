<?php
use Orange\User;

if(User::login_check()) {
    echo '<div class="container-fluid"><div class="row">';
    if (isset($_GET['page']) && $_GET['page']) {
        $page_path = PAGE_PATH . $_GET['page'] . '.php';
        if (file_exists($page_path)) {
            echo '<div class="col-md-2 ml-n3 bg-dark text-white min-vh-100">';
                include TEMPLATE_PATH . 'menu.php';
            echo  '</div>';
            echo '<div class="col-md-10 mt-5" id="content">';
                include_once(PAGE_PATH . $_GET['page'] . '.php');
            echo '</div>';
        } else {
            include_once(PAGE_PATH . '404.php');
        }
    } else {
        echo '<div class="col-md-2 ml-n3 bg-dark text-white min-vh-100">';
            include TEMPLATE_PATH . 'menu.php';
        echo  '</div>';
        echo '<div class="col-md-10 mt-5" id="content">';
            include_once(PAGE_PATH . 'home.php');
        echo '</div>';
    }
    echo '</div>';
}else{
    echo '<div id="content">';
    include_once(PAGE_PATH . 'login.php');
    echo '</div>';
}
//print_r($_SESSION);
