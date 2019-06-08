
<div class="container">
  <br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
       <?php 

               
              $stmt = $conn->prepare("SELECT * FROM photos");

              $stmt->execute();
             
              $count  = 0;
             // $row = select('*', 'photos', 'WHERE user_id = ?', $id ,'id', 'ASC');
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
               
                if ($count == 0) {
                   echo '
                   <li data-target="#myCarousel" data-slide-to="'.$count.'" class="active"></li>
                   ';
                } else {
                   echo '
                   <li data-target="#myCarousel" data-slide-to="'.$count.'"></li>
                   ';
                }
                $count = $count + 1;
               }

        ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <?php 
 
              $stmt = $conn->prepare("SELECT * FROM photos");

              $stmt->execute();
             
              $count  = 0;
           //$row = select('*', 'photos', 'WHERE user_id = ?', $id,'id', 'ASC');
           while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            if($count == 0) {
              echo '<div class="item active">';
            } else {
               echo '<div class="item" style="background: url(public/images/{$row["avatar"]})">';
            }
            echo "
             <div class='bg-slider' style='background: url(public/images/{$row["avatar"]})'></div>
             
            </div>
            ";
            $count = $count + 1;
           }
      ?>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<div class="container">
  <br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
       <?php 

               
              $stmt = $conn->prepare("SELECT * FROM photos");

              $stmt->execute();
             
              $count  = 0;
             // $row = select('*', 'photos', 'WHERE user_id = ?', $id ,'id', 'ASC');
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
               
                if ($count == 0) {
                   echo '
                   <li data-target="#myCarousel" data-slide-to="'.$count.'" class="active"></li>
                   ';
                } else {
                   echo '
                   <li data-target="#myCarousel" data-slide-to="'.$count.'"></li>
                   ';
                }
                $count = $count + 1;
               }

        ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <?php 
 
              $stmt = $conn->prepare("SELECT * FROM photos");

              $stmt->execute();
             
              $count  = 0;
           //$row = select('*', 'photos', 'WHERE user_id = ?', $id,'id', 'ASC');
           while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            if($count == 0) {
              echo '<div class="item active">';
            } else {
               echo '<div class="item" style="background: url(public/images/{$row["avatar"]})">';
            }
            echo "
             <div class='bg-slider' style='background: url(public/images/{$row["avatar"]})'></div>
             
            </div>
            ";
            $count = $count + 1;
           }
      ?>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
