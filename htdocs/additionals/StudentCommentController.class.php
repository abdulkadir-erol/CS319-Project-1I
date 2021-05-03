<?php
/*
StudentController class
Controller part of the MVC architecture
*/
class StudentCommentController extends StudentComment
{
  //Insert a new student comment to the database by calling the method function
  //@parameter $targetID the ID of the student receiving the peer comment
  //@parameter $comment comment made to the student
  //@parameter $date the date which the review is submitted
  //@paramter $authorID the ID of writer of the comment
  //@parameter contribution_grade grade given for contribution criteria
  //@parameter participation_grade grade given for participation criteria
  //@parameter communication_grade grade given for communication criteria
  //@parameter knowledge_grade grade given for knowledge criteriav
  public function insertDB($comment,$targetID,
                              $authorID, $date,
                              $contribution_grade,
                              $participation_grade,
                              $communication_grade,
                              $knowledge_grade)
  {

     $this->insertStudentCommentToDB($comment,$targetID,
                                $authorID, $date,
                                $contribution_grade,
                                $participation_grade,
                                $communication_grade,
                                $knowledge_grade);
  }

}
