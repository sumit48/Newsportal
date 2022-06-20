<?php

    if($_SESSION['role'] != 'admin'){
        redirect('dashboard.php','warning','You do not have permission to access this page.');
    }