<?php
/*
StudentController class
Controller part of the MVC architecture
*/
class StudentController extends Student
{

    public function validateStudent($email, $password)
    {
      $this->checkCredentials($email,$password);
    }

    public function createStudent($email, $password, $studentID, $name,
                                $groupNumber,$section)
    {
    $this->insertStudent($email, $password, $studentID, $name,
                      $groupNumber,$section);
    }
}
