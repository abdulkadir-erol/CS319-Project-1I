<?php
  /*
  Host class
  Model part of the MVC architecture
  */
  class Host extends db{
    private $email;
    private $password;
    private $hostName;
    //private $profilePicture;
    //Constructor with parameter
    public function __construct($email= "",$password= "",
                                $hostName = "")
    {
      $this->hostName = $hostName;
      $this->email = $email;
      $this->password = $password;
    }

    //Destructor
    public function __destruct()
    {

    }

    //Setter Methods
    protected function setHostName($hostName){
      $this->hostName = $hostName;
    }

    protected function setHostEmail($email){
      $this->email = $email;
    }
    protected function setHostPassword($password){
      $this->password = $password;
    }


    //Getter Methods
    protected function gethostName(){
      return $this->hostName;
    }

    protected function getHostEmail(){
      return $this->email;
    }
    protected function getHostPassword(){
      return $this->password;
    }

    protected function getHosts(){
      $sql = "SELECT * FROM host";
      $stmt = $this->connect()->query($sql);
      $result = $stmt->fetchAll();
      return $result;
    }


    protected function getHostByEmail($email){
      $sql = "SELECT * FROM host WHERE email = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([]);
      $result = $stmt->fetchAll();
      return $result;
    }

    //a function that is used for login
    //@parameter email -> email address of the student
    //@parameter password -> password of the student
    protected function checkCredentials($email, $password)
    {
      try {
        //first check if the given email exists.
        $sql = "SELECT * FROM host WHERE email = '$email'";
        //prepare the connection for retrieval
        $stmt = $this->connect()->prepare($sql);
        //execute the retrieval statement
        $stmt->execute([]);
        //put the results in to an array
        $results = $stmt->fetchAll();

        if(count($results) > 0)
        {
          //since there is only 1 account with 1 email the index position
          //in the results array is 0.
          //verify the password by comparing the parameter and database value
          if( $password == $results[0]['password'])
          {
            //assign the session user by using id and redirect to the
            //host home page
            //session variable is assigned as the id created by the DB
            //by doing this we do not store any user entered information
            //while in a session
            $_SESSION['hostuser'] = $results[0]['id'];
            header('location:studenthome.php');
          }
          else {
            echo "Wrong Password";
          }

        }
        else {
          echo "Email is not in database";
        }
      } catch (PDOException $e) {
          echo $e->getMessage();
      }
    }


    protected function shuffleGroups()
    {

    }

    protected function closeCourse()
    {

    }

  }
 ?>
