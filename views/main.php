<!doctype html>
<html lang="en">
  <head>
    <title>PassDown</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="<?= ROOT_URL ?>assets/css/uikit.min.css">
    <link rel="stylesheet" type="text/css" href="<?= ROOT_URL ?>assets/css/uikit-rtl.min.css">
    <link rel="stylesheet" type="text/css" href="<?= ROOT_URL ?>assets/css/custom.css">
  </head>
  <body class="container">
      <header class="header clearfix">
        <nav>
                

          <ul class="nav nav-pills float-right">
            <li class="nav-item">
              <a class="nav-link active" href="<?php echo ROOT_URL; ?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo ROOT_URL; ?>index.php?controller=home&action=event">Event <span class="sr-only">(current)</span></a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="<?php echo ROOT_URL; ?>index.php?controller=home&action=maintenance">Maintenance <span class="sr-only">(current)</span></a>
            </li>           
            <li class="nav-item">
              <a class="nav-link" href="<?php echo ROOT_URL; ?>index.php?controller=users&action=userlists">Users</a>
            </li>

<?php if(isset($_SESSION['is_logged_in'])){ ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo ROOT_URL; ?>index.php?controller=users&action=logout">Logout</a>
            </li>
            <li class="nav-link"><a style="color:black;text-decoration: none;" href="javascript:void(0)">(<?php echo $_SESSION['user_data']['name']; ?>)</a></li>


<?php }else{ ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo ROOT_URL; ?>index.php?controller=users&action=login">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo ROOT_URL; ?>index.php?controller=users&action=register">SignUp</a>
            </li>
    <?php } ?>
</ul>

        </nav>
        <a href="<?php echo ROOT_URL; ?>"><h3 class="text-muted">PassDown</h3></a>
      </header>

    <main class="">
      <?php noticeMsg::displayNoticeMsg(); ?>
      <?php require($view); ?>
    </main>

   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script>
      let ROOT_URL = `<?= ROOT_URL ?>`
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?= ROOT_URL ?>assets/js/uikit.min.js"></script>
    <script src="<?= ROOT_URL ?>assets/js/uikit-icons.min.js"></script>
    <script src="<?= ROOT_URL ?>assets/js/custom.js"></script>
    <?php
$customscript = str_replace(".php", ".js", $view);
$customscript = str_replace("views/", "", $customscript);
$customscriptm = "assets/js/".$customscript;
$customscript = ROOT_PATH.$customscriptm; 

if(file_exists($customscript)){
  echo '<script src="'.ROOT_URL.$customscriptm.'"></script>';
}
     ?>
  </body>
</html>