<?php 

/*

                      tests 


   // constant 
   const CHAR = 5;

   // methods 
   public function charcterName(){
   	 if (strlen($this->charcterName) < self::CHAR ) {
   	 	echo 'Name must be more than 5 charcter';
   	 }
   }

          
    function lock($lock) {
   	  $this->lock = sha1($lock);
   }

*/







/* apple */

class iphone {
   
   public  $ram;
   public  $inch;
   public  $space;
   public  $color;

   function changeIphone($ram = '1GB', $inch = '5 Inch', $space = '8GB', $color = 'white') {
   	   $this->ram   = $ram;
   	   $this->inch  = $inch;
   	   $this->space = $space;
   	   $this->color = $color;

   }

  

   

}

     // Sony Class


class sony extends iphone {
	 
	  public $camera;


	  function changeSony($ram = '1GB', $inch = '5 Inch', $space = '8GB', $color = 'white', $camera  = '20MB') {
   	   $this->ram    = $ram;
   	   $this->inch   = $inch;
   	   $this->space  = $space;
   	   $this->color  = $color;
   	   $this->camera = $camera;

   }

	
}



   // iphone 6
$iphone6 = new iphone();
$iphone6->changeIphone('2GB', '5 inch', '16GB', 'red');

echo "<pre>";
print_r($iphone6);
echo "</pre>";

 // iphone 6
$sony = new sony();
$sony->changeSony('2GB', '5 inch', '16GB', 'red');

echo "<pre>";
print_r($sony);
echo "</pre>";


if (class_exists("sony")) {
   echo "yes<br>";
} else {
   echo "No<br>";
}


$methods = get_class_methods('iphone');

foreach ($methods as $method) {
   echo "Yes, Method does exist<br>";
}


class test {
    function say_hello() {
      echo "Hello everyone form inside ". get_class($this) . " class<br>";
   }

   function hello() {
      $this->say_hello();
   }
}

$test = new test();

$test->say_hello();
$test->hello();








            // call all classes
// $classes = get_declared_classes();

// foreach ($classes as $class) {
//     echo $class. "<br>";
// }

?>