<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-height, initial-scale=0.5, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    <link rel="stylesheet" href="/assets/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/layout.css">

    <?php if( isset($cssFiles) && is_array($cssFiles) && count($cssFiles)){
        foreach($cssFiles as $cssFile){
            echo '<link rel="stylesheet" href="'.$cssFile.'" />';
        }
    } ?>

    <title>matemoto.com - Imaginary Guestbook</title>
</head>
<body>
<div id="top"></div>
<div id="nav-top-bg" class="container-fluid fixed-top navbar-expand">
    <nav id="nav-top" class="navbar container">
        <a class="navbar-brand" href="#top">
            <div id="nav-logo"></div>
        </a>

        <ul class="navbar-nav nav">
            <li class="nav-item">
                <a class="nav-link" href="#top"><i class="fa fa-angle-double-up" aria-hidden="true"></i> Top</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#review-list"><i class="fa fa-comments" aria-hidden="true"></i> Reviews</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#review-form"><i class="fa fa-commenting" aria-hidden="true"></i> Rate Us!</a>
            </li>
        </ul>

    </nav>
</div>

<div id="content" class="container-fluid">
    <?php echo $content; ?>
</div>

<div id="footer" class="container-fluid full-width-content">
    <div class="container flex-row">
        <span style="float: left;">
            <i class="fa fa-envelope" aria-hidden="true" style="color: rgb(200,255,0);"></i> mate.simon@matemoto.com
        </span>
        <a href="https://github.com/Matheus90/guestbook-test-project" target="_blank" style="float: right; color: rgb(200,255,0);">
            <i class="fa fa-github" aria-hidden="true" style="font-size: 20px;"></i> Public Code
        </a>
        <span style="font-family: courier, monospace;"><?php echo htmlspecialchars('{ Hope you like it }'); ?></span>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script src="/assets/js/layout.js"></script>

<?php if( isset($scriptFiles) && is_array($scriptFiles) && count($scriptFiles)){
    foreach($scriptFiles as $scriptFile){
        echo '<script src="'.$scriptFile.'"></script>';
    }
} ?>

</body>
</html>