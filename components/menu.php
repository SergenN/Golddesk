<?php 
$
$title

?>
<nav class="narbar navbar-inverse navbar-static-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/index.php">Golddesk</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if($title=="home"){; echo 'class="active"';}?> ><a href="/index.php">Home</a></li>
        <?php if($_SESSION['level']==(1||2) ){?>
        
        <li <?php if($title=="ticket"){; echo 'class="active"';}?>><a href="/ticket/index.php">nieuw ticket</a></li>
        <?php }  ?>
        
        <?php  if(isset($_SESSION['id'])){?>
            <li <?php if($title=="Account"){; echo 'class="active"';}?>><a href="/account/index.php">Account</a></li>
            <li <?php if($title=="logout"){; echo 'class="active"';}?>><a href="/login/login_logout.php">Logout</a></li>
        <?php }else{?>
            <li <?php if($title=="login"){; echo 'class="active"';}?>><a href="/login/index.php">Login</a></li>
        
        <?php }?>
      </ul>
      <!--<form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Zoeken...">
        </div>
        <button type="submit" class="btn btn-default">Zoek</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
        
      </ul>-->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

