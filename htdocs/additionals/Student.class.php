<?php
/*
Student class
Model part of the MVC architecture
*/
class Student extends Db
{
    //Properties of the student
    private $email;
    private $password;
    private $studentID;
    private $name;
    private $groupNumber;
    private $section;


    //Constructor with parameter
    public function __construct($email= "",$password= "",
                                $name = "",$studentID = 0 ,
                                $groupNumber = 0, $section = 0)
    {
      $this->name = $name;
      $this->studentID = $studentID;
      $this->email = $email;
      $this->password = $password;
      $this->groupNumber = $groupNumber;
      $this->section = $section;
    }

    //Destructor
    public function __destruct()
    {

    }
    //Setter Methods
    protected function setName($name){
      $this->name = $name;
    }
    protected function setStudentID($studentID){
      $this->studentID = $studentID;
    }
    protected function setEmail($email){
      $this->email = $email;
    }
    protected function setPassword($password){
      $this->password = $password;
    }
    protected function setGroupNumbere($groupNumber){
      $this->groupNumber = $groupNumber;
    }
    protected function setSection($section){
      $this->section = $section;
    }

    //Getter Methods
    protected function getName(){
      return $this->name;
    }
    protected function getStudentID(){
      return $this->studentID;
    }
    protected function getEmail(){
      return $this->email;
    }
    protected function getPassword(){
      return $this->password;
    }
    protected function getGroupNumber(){
      return $this->groupNumber;
    }
    protected function getSection()
    {
      return $this->section;
    }

    //Return all student from database
    protected function getStudents()
    {
      $sql = "SELECT * FROM student";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([]);
      //put all table entries into an array
      $results = $stmt->fetchAll();
      return $results;  //return the array
    }
     //Return a student from database using ID
     //@parameter id -> the id of the student
     //@return  results -> the array containing the student.
    protected function getStudentByID($id)
    {
      //find matching table entries
      $sql = "SELECT * FROM student WHERE id = '$id'";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([]);
      //put the information into an array
      $results = $stmt->fetchAll();
      return $results;
    }

    //Return a student from database using ID
    //@parameter email -> the email of the student
    //@return  results -> the array containing the student.
    protected function getStudentByEmail($email)
    {
      $sql = "SELECT * FROM student WHERE email = '$email'";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([]);
      $results = $stmt->fetchAll();
      return $results;
    }

    //Insert a student to database
    //@parameter email -> email address of the student
    //@parameter password -> password of the student
    //@parameter studentID -> id of the student
    //@parameter name -> name of the student
    //@parameter $groupNumber -> groupnum of the student
    //@parameter $section -> section of the student
    protected function insertStudent($email, $password, $studentID, $name,
                                $groupNumber,$section)
      {
      //first check if the given email exists.
      if(count($this->getStudentByEmail($email)) > 0)
      {
        echo "There is a account with given e-mail account";
      }
      //if the email does not exists in DB, try to insert the user
      else
      {
        try {
          //Hashing is used to increase security
          $password = password_hash($password, PASSWORD_DEFAULT);
          //create the sql command. Question marks will be replaced below
          $sql = "INSERT INTO student(email,password,
                                      name,studentID,group_number,section)
                                      VALUES (?,?,?,?,?,?)";
          //prepare the connection for insertion
          $stmt = $this->connect()->prepare($sql);
          //execute the insertion by replacing variables
          $stmt->execute([$email,$password,$studentID,$name,$groupNumber,$section]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
      }
      }


    //a function that is used for login
    protected function checkCredentials($email, $password)
    {
      try {
        //first check if the given email exists.
        $sql = "SELECT * FROM student WHERE email = '$email'";
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
          if( password_verify($password, $results[0]['password']))
          {
            //assign the session user by using id and redirect to the
            //student home page
            $_SESSION['user'] = $results[0]['id'];
            header('location:studenthome.php');
          }
          else {
            echo "Wrong Password";
          }

        }
        else {
          echo "Account is not in database";
        }
      } catch (PDOException $e) {
          echo $e->getMessage();
      }


    }
}
 ?>
