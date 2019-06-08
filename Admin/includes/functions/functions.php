<?php 
// redirect to directly
function redirect_to($url = null){

  if ($url === null) {

    $url = "main.php?go=main";

  } else {

    if (isset($_SERVER['HTTP_REFERER'])) {

       $url = $_SERVER['HTTP_REFERER'];        

    } else{
      $url = "main.php?go=main";
    }
  }

  header("Location: " .$url );
  exit();
} 


// redirect to  with time
function redirect_to_main_page( $page = 'main.php'){
  echo"<div class='alert alert-danger'>you can't browse this page directly.</div>";;
  header("refresh: 3 ; url = $page");
  exit();
} 


// retrive the data when i make refresh.
function old($key) {
  if (isset($_SESSION['data']) && isset($_SESSION['data'][$key])) {
    echo $_SESSION['data'][$key];
    unset($_SESSION['data'][$key]);
  } else {
    echo null;
  }
}



// check status


function check_status($value){

  global $conn;
  global $count;
  $stmt2 = $conn->prepare("SELECT username, reg_status FROM users WHERE username = ? AND reg_status = 0");

  $stmt2->execute(array($value));
  
  $count = $stmt2->rowCount(); 
  
  return $count;

}






// count items

function count_items($item, $table = 'users', $where = null){

  global $conn;

  $stmt2 = $conn->prepare("SELECT count($item) FROM $table $where");

  $stmt2->execute();

  $column = $stmt2->fetchColumn();
  
  return $column;

}



// select with condition


function select_items_with_condition($item, $table = 'users', $value, $x = ''){

  global $conn;

  $stmt2 = $conn->prepare("SELECT $item FROM $table WHERE $item = ? {$x}");

  $stmt2->execute(array($value));

  $stmt2->fetchColumn();
  
  $count = $stmt2->rowCount(); 
  
  return $count;

}



// page title
function get_title(){

  global $pagetitle;

  if (isset($pagetitle)) {

    echo $pagetitle;

  } else{

    echo "page";

  }
   return $pagetitle;
}



// get latest members  

function get_members_or_sections($item, $table = 'users',  $order = "name", $DESC = 'DESC', $limit = 5){

  global $conn;

  $stmt2 = $conn->prepare("SELECT $item FROM $table ORDER BY $order $DESC LIMIT $limit");

  $stmt2->execute();

  $column = $stmt2->fetchAll();
  
  return $column;

}



// select username and echo it in the navbar
function name($x = 'id', $y = 'user_id', $z){

global $conn;
global $auth;

$auth = null;

if (isset($_SESSION[$x]) && !empty($_SESSION[$x])) {

        $stmt =$conn->prepare("SELECT * FROM users WHERE $y = ? LIMIT 1");
        $stmt->execute(array($z));
        $auth = $stmt->fetch();

        echo $auth['username'];

   }

   return $auth;

}


// success message
function msg() {

  if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {

      echo "<div class='alert alert-success'>{$_SESSION['msg']}</div>"; 

      unset($_SESSION['msg']);

   } elseif (isset($_SESSION['error']) && !empty($_SESSION['error'])) {

        echo "<div class='alert alert-danger'>{$_SESSION['error']}</div>";

        unset($_SESSION['error']);
        
  } else {
    echo "";
  }
                                 
}

/*select*/


function select($item, $table, $where = null, $value = null,  $order = 'id', $DESC = 'DESC', $limit = 100000){

  global $conn;

  $stmt = $conn->prepare("SELECT $item FROM $table $where ORDER BY $order $DESC LIMIT $limit");

  $value == null ? $stmt->execute() : $stmt->execute(array($value));
  
  $rows = $stmt->fetchAll();

  $count = $stmt->rowCount();
  
  return $rows;

  return $count;

}

/* Delete */
function delete($table, $where, $value, $txt = 'User') {
   global $conn;
   $stmt = $conn->prepare("DELETE FROM $table WHERE $where = ? LIMIT 1");
   $stmt->execute(array($value));

   $msg = $txt." <b>Deleted</b> successfully";
   $_SESSION['msg'] = $msg ;
   redirect_to('back'); 
}





/*============== Check Errors ========*/
$validate = [];
          
          //check_empty
function check_empty($x, $y = 'name'){
   global $validate;
   if (empty($x)) {
       $validate [] = $y." can't be blank";
     }
} 

          //check lenth 
function check_lenth($x, $y = 'name', $len = 4) {
  global $validate;
  if (strlen($x) < $len ) {
    $validate [] = $y." can't be less than 4 characters";
   } 
   // print_r($GLOBALS);
   // die();
} 



/*========slider ===========*/


// function make_indic() {

//   $output = '';
//   $count  = 0;
//   $rows = select('*', 'photos', 'WHERE user_id = ?', $id,'id', 'ASC');
//   foreach ($rows as $row) {
//     if ($count == 0) {
//        $output .= '
//        <li data-target="#myCarousel" data-slide-to="'.$count.'" class="active"></li>
//        ';
//     } else {
//        $output .= '
//        <li data-target="#myCarousel" data-slide-to="'.$count.'"></li>
//        ';
//     }
//     $count = $count + 1;
//    }
//    return $output;
// }

// function make_slides($connect) {
//  $output = '';
//  $count = 0;
//  $rows = select('*', 'photos', 'WHERE user_id = ?', $id,'id', 'ASC');
//  foreach ($rows as $row) {
  
//   if($count == 0) {
//    $output .= '<div class="item active">';
//   } else {
//    $output .= '<div class="item">';
//   }
//   $output .= '
//    <img src="public/images/<?php echo $row[avatar];






  



?>


