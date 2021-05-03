<?php
class GroupController extends Group{
  //Function that validates the host credentials during Login
  //@parameter email -> email address of the host
  //@parameter password -> password of the host
  final public function createGroup($section, $groupNumbers, $minGroupSize, $maxGroupSize)
  {
    $this->createGroups($section, $groupNumbers, $minGroupSize, $maxGroupSize);
  }

  final public function deleteGroups($section, $groupNum)
  {
    $this->deleteGroup($section, $groupNum);
  }

  final public function addStudentGroup($studentID, $section, $groupNum)
  {
    $this->addStudentToAGroup($studentID, $section, $groupNum);
  }


  final public function closeCourses()
  {
    $this->closeCourse();
  }

  final public function shuffleStudent($sectionNumber)
  {
    $this->shuffle($sectionNumber);
  }

  final public function denyChangeRequests($studentID, $groupNum)
  {
    $this->denyChangeRequest($studentID, $groupNum);
  }

  final public function changeGroupRequests($studentID, $groupNum)
  {
    $this->changeGroupRequest($studentID, $groupNum);
  }

  final public function denyRequests($studentID, $groupNum)
  {
    $this->denyChangeRequest($studentID, $groupNum);
  }
  final public function sendChangeRequest($studentID, $groupNum)
  {
    $this->insertChangeRequest($studentID, 0, $groupNum);
  }

}
 ?>
