<?php
/*
StudentController class
Controller part of the MVC architecture
*/
class StudentController extends Student
{
    //Function that validates the student credentials during Login
    //@parameter email -> email address of the student
    //@parameter password -> password of the student
    final public function validateStudent($email, $password)
    {
      $this->checkCredentials($email,$password);
    }

    //function that creates a student in the DB by calling model class method
    //@parameter email -> email address of the student
    //@parameter password -> password of the student
    //@parameter studentID -> id of the student
    //@parameter name -> name of the student
    //@parameter $groupNumber -> groupnum of the student
    //@parameter $section -> section of the student
    public function createStudent($email, $password, $studentID, $name,
                                $groupNumber,$section)
    {
    $this->insertStudent($email, $password, $studentID, $name,
                      $groupNumber,$section);
    }

public function getStuByStudentID($studentID)
{
  return $this->getStudentByStudentID($studentID);
}
public function getStuByStudentGroup($groupNum,$section)
    {
      return $this->getStudentsByGroup($groupNum,$section);
    }
    public function updateStuInfo($password,$studentID)
    {
      $this->updateStudentInfo($password,$studentID);
    }
}
