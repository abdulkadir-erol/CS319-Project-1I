<?php
/*
ArtifactComment class
Model part of the MVC architecture
*/
class ArtifactComment extends Db
{
  private $comment;
  private $authorID;
  private $date;
  private $groupNum;
  private $artifactName;

  public function __construct($comment= "",$groupNum= "",
                              $authorID = "", $date = "", $artifactName = "")
  {
    $this->comment = $comment;
    $this->groupNum = $groupNum;
    $this->authorID = $authorID;
    $this->date = $date;
    $this->artifactName = $artifactName;
  }

  //Setter methods for properties
  protected function setComment($comment){
    $this->comment = $comment;
  }
  protected function setGroupNum($groupNum){
    $this->groupNum = $groupNum;
  }
  protected function setAuthorID($authorID){
    $this->authorID = $authorID;
  }
  protected function setDate($date){
    $this->date = $date;
  }
  protected function setArtifactName($artifactName){
    $this->artifactName = $artifactName;
  }

  //Get methods for variables
  protected function getComment(){
    return $this->comment;
  }
  protected function getGroupNum(){
    return $this->groupNum;
  }
  protected function getAuthorID(){
    return $this->authorID;
  }
  protected function getDate(){
    return $this->date;
  }
  protected function getArtifactName(){
    return $this->artifactName;
  }

  //Insert a new artifact comment to the database
  //@parameter $artifactName name of the artifact
  //@parameter $grouNum the number of the group that the artifact belongs
  //@parameter $comment comment made to the artifact
  //@parameter $date the date which the review is submitted
  //@paramter $authorID the ID of writer of the comment
   public function  insertArtifactCommentToDB($comment ,$groupNum,
                               $authorID, $date, $artifactName)
   {
          //Check if there is a artifact to prevent duplicate entries
          $sql = "SELECT * FROM artifact_comment WHERE group_num = '$groupNum' AND
                        artifact_name = '$artifactName' AND author_id = '$authorID'";
          $stmt = $this->connect()->prepare($sql);
          $stmt->execute([]);
          //put all table entries into an array
          $results = $stmt->fetchAll();
          if(count($results) == 0)
          {
            try {
          //create the sql command. Question marks will be replaced below
          $sql = "INSERT INTO artifact_comment(comment,author_id, date_of_submission,
                                      group_num,artifact_name)
                                      VALUES (?,?,?,?,?)";
          //prepare the connection for insertion
          $stmt = $this->connect()->prepare($sql);
          //execute the insertion by replacing variables
          $stmt->execute([$comment, $authorID, $date,$groupNum,$artifactName]);
            } catch (PDOException $e) {
              echo $e->getMessage();
            }
          }
          //Update method can be added here ?

    }

    //Return all artifact comments from database
    //@return  results -> the array containing the all artifact comments
    protected function getArtifactComments()
    {
      $sql = "SELECT * FROM artifact_comment";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([]);
      //put all table entries into an array
      $results = $stmt->fetchAll();
      return $results;  //return the array
    }

    //return all artifact comments written about a group
    //@param $groupNum the number of group
    //@return the array containing the all artifact comments belonging to the
    //specified group
    protected function getArtifactCommentsByGroupName($groupNum)
    {
      //find matching table entries
      $sql = "SELECT * FROM artifact_comment WHERE group_num = '$groupNum'";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([]);
      //put the information into an array
      $results = $stmt->fetchAll();
      return $results;
    }

    //return all artifact comments written about a type of artifact
    //@param $artifactName name of the artifact example Analysis IT1
    //@return the array containing the all artifact comments belonging to the
    //specified artifact
    protected function getArtifactCommentsByArtifactName($artifactName)
    {
      //find matching table entries
      $sql = "SELECT * FROM artifact_comment WHERE artifact_name = '$artifactName'";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([]);
      //put the information into an array
      $results = $stmt->fetchAll();
      return $results;
    }
    //Deletes all the artifact comments belonging to an artifact of an specific group
    public function deleteArtifactComment( $artifactName, $groupNum)
    {
      $sql = "DELETE FROM artifact_comment WHERE group_num = '$groupNum'  AND artifact_name = '$artifactName'";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute(array(
        ':artifact_name' => $artifactName,
        ':group_num' => $groupNum
        ));

    }

}
