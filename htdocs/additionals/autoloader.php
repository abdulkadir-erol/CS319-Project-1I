<?php
//Autoloaders in PHP is used to include specific classes inside other classses
//where the specific class instance is used.

spl_autoload_register("autoLoader"); // calling the function below

//constructing the path where the php file exists.
function autoLoader($className)
{
  $path = "additionals/";
  $extension = ".class.php";
  $fullPath = $path . $className . $extension;

  //Check if the file exists
  if(!file_exists($fullPath))
  {
    return false;
  }
  else {
      include_once $fullPath;
  }


}
