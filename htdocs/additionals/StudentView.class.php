<?php

/*
Studentview class
View part of the MVC architecture
*/
class StudentView extends Student{


//A function that displays all students
public function showStudents()
{
  $results = $this->getStudents();
  foreach ($results as $user) {
    echo "Name: " . $user["name"] . "\t" . "StudentID:" .$user["studentID"]
                  . "\t" . "GroupNum:" . $user["group_number"];
                }
}

//function that displays students by group
//@param $groupNum group number of the students
public function showStudentsByGroup($groupNum)
{
  $results = $this->getStudentsByGroup($groupNum);
  foreach ($results as $user) {
    echo "Name: " . $user["name"] . "\t" . "StudentID:" .$user["studentID"]
                  . "\t" . "GroupNum:" . $user["group_number"];
                }
}
}
