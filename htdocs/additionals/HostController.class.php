<?php
class HostController extends Host{
  //Function that validates the host credentials during Login
  //@parameter email -> email address of the host
  //@parameter password -> password of the host
  final public function validateHost($email, $password)
  {
    $this->checkCredentials($email,$password);
  }

  final public function getHostsByEmail($email)
  {
    return $this->getHostByEmail($email);
  }
}
 ?>
