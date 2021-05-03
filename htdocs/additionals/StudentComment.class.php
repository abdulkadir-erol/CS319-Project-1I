<?php
/*
StudentComment class
Model part of the MVC architecture
*/
class StudentComment extends Db
{
  private $comment;
  private $authorID;
  private $date;
  private $targetID;
  private $contribution_grade;
  private $participation_grade;
  private $communication_grade;
  private $knowledge_grade;


  public function __construct($comment= "",$targetID= "",
                              $authorID = "", $date = "",
                              $contribution_grade = "",
                              $participation_grade = "",
                              $communication_grade = "",
                              $knowledge_grade = "")
  {
    $this->comment = $comment;
    $this->targetID = $targetID;
    $this->authorID = $authorID;
    $this->date = $date;
    $this->contribution_grade = $contribution_grade;
    $this->participation_grade = $participation_grade;
    $this->communication_grade = $communication_grade;
    $this->knowledge_grade = $knowledge_grade;
  }

  //Setter methods for properties
  protected function setComment($comment){
    $this->comment = $comment;
  }
  protected function setTargetID($targetID){
    $this->targetID = $targetID;
  }
  protected function setAuthorID($authorID){
    $this->authorID = $authorID;
  }
  protected function setDate($date){
    $this->date = $date;
  }
  protected function setContributionGrade($contribution_grade){
    $this->contribution_grade = $contribution_grade;
  }

  protected function setCommunicationGrade($communication_grade){
    $this->communication_grade = $communication_grade;
  }

  protected function setParticipationGrade($participation_grade){
      $this->participation_grade = $participation_grade;
  }

  protected function setContributionGraded($knowledge_grade){
    $this->knowledge_grade = $knowledge_grade;
  }

  //Get methods for variables
  protected function getComment(){
    return $this->comment;
  }
  protected function getTargetID(){
    return $this->targetID;
  }
  protected function getAuthorID(){
    return $this->authorID;
  }
  protected function getDate(){
    return $this->date;
  }
  protected function getKnowledgeGrade(){
    return $this->knowledge_grade;
  }
  protected function getParticipationGrade(){
    return $this->participation_grade;
  }
  protected function getCommunicationGrade(){
    return $this->communication_grade;
  }
  protected function getContributionGrade(){
    return $this->contribution_grade;
  }

  //Insert a new student comment to the database
  //@parameter $targetID the ID of the student receiving the peer comment
  //@parameter $comment comment made to the student
  //@parameter $date the date which the review is submitted
  //@paramter $authorID the ID of writer of the comment
  //@parameter contribution_grade grade given for contribution criteria
  //@parameter participation_grade grade given for participation criteria
  //@parameter communication_grade grade given for communication criteria
  //@parameter knowledge_grade grade given for knowledge criteria
   public function  insertStudentCommentToDB($comment,$targetID,
                               $authorID, $date,
                               $contribution_grade,
                               $participation_grade,
                               $communication_grade,
                               $knowledge_grade)
   {
          //Check if there is a artifact to prevent duplicate entries
          $sql = "SELECT * FROM peer_comment
                        WHERE target_student_id = '$targetID' AND
                        author_id = '$authorID'";
          $stmt = $this->connect()->prepare($sql);
          $stmt->execute([]);
          //put all table entries into an array
          $results = $stmt->fetchAll();
          if(count($results) == 0)
          {
            try {
          //create the sql command. Question marks will be replaced below
          $sql = "INSERT INTO peer_comment(author_id,
                                            target_student_id,
                                            date_of_submission,
                                            contribution_grade,
                                            participation_grade,
                                            communication_grade,
                                            knowledge_grade,
                                            comment)
                                      VALUES (?,?,?,?,?,?,?,?)";
          //prepare the connection for insertion
          $stmt = $this->connect()->prepare($sql);
          //execute the insertion by replacing variables
          $stmt->execute([$authorID,$targetID, $date,
                                      $contribution_grade,
                                      $participation_grade,
                                      $communication_grade,
                                      $knowledge_grade,
                                      $comment]);
            } catch (PDOException $e) {
              echo $e->getMessage();
            }
          }
          else {
            echo "You have already a comment about " . $targetID;
          }

    }

    //Return all peer comments from database
    //@return  results -> the array containing the all artifact comments
    protected function getStudentComments()
    {
      $sql = "SELECT * FROM peer_comment";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([]);
      //put all table entries into an array
      $results = $stmt->fetchAll();
      return $results;  //return the array
    }

    //return all student comments written by the same author
    //@param $authorID ID of the group
    //@return the array containing all peer reviews written by the same person
    //specified group
    protected function getStudentCommentsByAuthorID($authorID)
    {
      //find matching table entries
      $sql = "SELECT * FROM peer_comment WHERE author_id = '$authorID'";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([]);
      //put the information into an array
      $results = $stmt->fetchAll();
      return $results;
    }

    //return all student comments written about a particular studet
    //@param $targetID theID of the student
    //@return the array containing all student comments written about a particular studet
    protected function getStudentCommentsByTargetID($targetID)
    {
      //find matching table entries
      $sql = "SELECT * FROM peer_comment WHERE target_student_id = '$targetID'";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([]);
      //put the information into an array
      $results = $stmt->fetchAll();
      return $results;
    }
    //Deletes all the student comments belonging to an student
    public function deleteStudentComment( $authorID, $targetID)
    {
      $sql = "DELETE FROM peer_comment WHERE target_student_id = '$targetID'  AND author_id = '$authorID'";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute(
        array(
          ':target_student_id' => $targetID,
          ':author_id' => $authorID,
            )
          );

    }

}
