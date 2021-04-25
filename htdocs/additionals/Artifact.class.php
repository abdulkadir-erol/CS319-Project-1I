<?php
/*
Artifact class
Model part of the MVC architecture
*/
class Artifact extends Db
{
    //Properties of the student
    private $name;
    private $groupNum;
    private $link;


    //Constructor with parameter
    public function __construct($name= "",$groupNum= "",
                                $link = "")
    {
      $this->name = $name;
      $this->groupNum = $groupNum;
      $this->link = $link;
    }

    //Destructor
    public function __destruct()
    {

    }
    //Setter Methods
    protected function setName($name){
      $this->name = $name;
    }
    protected function setLink($link){
      $this->link = $link;
    }
    protected function setGroupNum($groupNum){
      $this->groupNum = $groupNum;
    }


    //Getter Methods
    protected function getName(){
      return $this->name;
    }
    protected function getGroupNum(){
      return $this->groupNum;
    }
    protected function getLink(){
      return $this->link;
    }

    //Returns all the artifacts from the database
    //@return  results -> the array containing the all artifacts
    public function getArtifacts()
    {
      $sql = "SELECT * FROM artifact";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([]);
      //put all table entries into an array
      $results = $stmt->fetchAll();
      return $results;  //return the array
    }

    //Returns the artifacts of a specific group
    //@parameter $groupNumber -> groupnum of the artifact
    //@return the arrray containing all the artifacts of a specific group
    protected function getArtifactsByGroup($groupNum)
    {
      $sql = "SELECT * FROM artifact WHERE group_number = '$groupNum'";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([]);
      //put all table entries into an array
      $results = $stmt->fetchAll();
      return $results;  //return the array
    }

    //Retruns all artifacts with the same name for example Analysis report IT1
    //@parameter $artifactName name of the artifact
    //return -> the array containing all artifacts with the same name
    protected function getArtifactsByName($artifactName)
    {
      $sql = "SELECT * FROM artifact WHERE name = '$artifactName'";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([]);
      //put all table entries into an array
      $results = $stmt->fetchAll();
      return $results;  //return the array
    }


  //deletes a specific artifact from the database
  //@parameter $artifactName name of the artifact
  //@parameter $grouNum the number of the group that the artifact belongs
  public function deleteArtifact( $artifactName, $groupNum)
  {
    $sql = "DELETE FROM artifact WHERE group_number = '$groupNum'  AND name = '$artifactName'";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();

  }


  //Insert a new artifact to the database
  //@parameter $artifactName name of the artifact
  //@parameter $grouNum the number of the group that the artifact belongs
  //@paratemeter $link the link to the artifact
   protected function  insertArtifactToDB($name, $groupNum, $link)
   {
          //Check if there is a artifact to prevent duplicate entries
          $sql = "SELECT * FROM artifact WHERE group_number = '$groupNum' AND name = '$name'";
          $stmt = $this->connect()->prepare($sql);
          $stmt->execute([]);
          //put all table entries into an array
          $results = $stmt->fetchAll();
          if(count($results) == 0)
          {
            try {
          //create the sql command. Question marks will be replaced below
          $sql = "INSERT INTO artifact(name,groupNum,
                                      link)
                                      VALUES (?,?,?)";
          //prepare the connection for insertion
          $stmt = $this->connect()->prepare($sql);
          //execute the insertion by replacing variables
          $stmt->execute([$name, $groupNum, $link]);
            } catch (PDOException $e) {
              echo $e->getMessage();
            }
          }
          //Update method can be added here ?

    }

}
