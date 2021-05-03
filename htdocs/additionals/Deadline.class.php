<?php
/*
Deaddline class
Model part of the MVC architecture
*/
class Deadline extends Db
{
    //Properties of the Deadline
    private $artifact_name;
    private $date;


    //Constructor with parameter
    public function __construct($name= "",$date= "")
    {
      $this->name = $name;
      $this->date = $date;
    }

    //Destructor
    public function __destruct()
    {

    }
    //Setter Methods
    protected function setName($name){
      $this->name = $name;
    }
    protected function setDate($date){
      $this->date = $date;
    }


    //Getter Methods
    protected function getName(){
      return $this->name;
    }
    protected function getDate(){
      return $this->date;
    }

    //Returns all the deadlines from the database
    //@return  results -> the array containing the all deadlines
    public function getDeadlines()
    {
      $sql = "SELECT * FROM deadline ORDER BY artifact_name";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([]);
      //put all table entries into an array
      $results = $stmt->fetchAll();
      return $results;  //return the array
    }

    //Retruns the dedadline associated with the a artifact
    //@parameter $artifactName name of the artifact
    //return -> the array containing the deadline
    protected function getDeadlineByName($artifactName)
    {
      $sql = "SELECT * FROM deadline WHERE artifact_name = '$artifactName'";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([]);
      //put all table entries into an array
      $results = $stmt->fetchAll();
      return $results;  //return the array
    }


  //deletes a specific deadline from the database
  //@parameter $artifactName name of the deadline
  public function deleteDeadline( $artifactName)
  {
    $sql = "DELETE FROM artifact WHERE group_number = '$groupNum'  AND name = '$artifactName'";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([]);

  }


  //Insert a new deadline to the database
  //@parameter $artifactName name of the artifact
  //@parameter $date the date of deadline
     protected function  insertDeadlineToDB($name, $date)
   {
          //Check if there is a artifact to prevent duplicate entries
          $sql = "SELECT * FROM deadline WHERE artifact_name = '$name'";
          $stmt = $this->connect()->prepare($sql);
          $stmt->execute([]);
          //put all table entries into an array
          $results = $stmt->fetchAll();
          if(count($results) == 0)
          {
            try {
          //create the sql command. Question marks will be replaced below
          $sql = "INSERT INTO deadline(artifact_name, date)
                                      VALUES (?,?)";
          //prepare the connection for insertion
          $stmt = $this->connect()->prepare($sql);
          //execute the insertion by replacing variables
          $stmt->execute([$name, $date]);
            } catch (PDOException $e) {
              echo $e->getMessage();
            }
          }
          else {
            $sql = "UPDATE deadline SET date = '$date' WHERE artifact_name = '$name'";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
          }


    }

}
