

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class=""><a href="main.php?go=main"><?php echo $lang["HOME_ADMIN"]; ?></a></li>
        <li><a href="sections.php?go=manage&sort=ASC"><?php echo $lang["CATEGORIES"]; ?></a></li>
        <li class=""><a href="items.php?go=manage"><?php echo $lang["ITEMS"]; ?></a></li>
        <li><a href="members.php?go=members"><?php echo $lang["MEMBERS"]; ?></a></li>
        <li class=""><a href="comments.php?go=manage"><?php echo $lang["COMMENTS"]; ?></a></li>
        <li class=""><a href="test.php">Test</a></li>
       <!--  <li><a href="#"><?php echo $lang["LOGS"]; ?></a></li> -->

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php name('id', 'user_id', $_SESSION['id']); ?><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="../shop/index.php">Visit Shop</a></li>
            <li><a href="members.php?go=edit&userid=<?php echo $_SESSION['id'];?>">Edit Profile</a></li>
            <li><a href="members.php?go=add">Add</a></li>
            <li><a href="logout.php">Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>