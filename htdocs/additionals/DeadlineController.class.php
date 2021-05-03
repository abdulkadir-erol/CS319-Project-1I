<?php
/*
DeadlineController class
Controller part of the MVC architecture
*/
class DeadlineController extends Deadline
{

  //Insert a new deadline to the database
  //@parameter $artifactName name of the artifact
  //@parameter $date the date of deadline
    public function  insertDeadline($name, $date)
    {
      $this-> insertDeadlineToDB($name, $date);
    }

    //deletes a specific deadline from the database
    //@parameter $artifactName name of the deadline
    public function deleteDeadlineByName( $name)
    {
      $this->deleteArtifact($name);
    }

    //a function that returns all deadlines
    //@param groupNum the group Number
    //@return all artifacts as an associative array
    public function getAllDeadlines()
    {
      return $this->getDeadlines();
    }
}
