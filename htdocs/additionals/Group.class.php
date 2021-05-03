<?php
class Group extends db{
  private $studentNumberInGroup;
  private $groupName;

  //Constructor with parameter
  public function __construct($studentNumberInGroup= 0,$groupName= "",)
  {
    $this->studentNumberInGroup = $studentNumberInGroup;
    $this->groupName = $groupName;
  }

  //Destructor
  public function __destruct()
  {

  }

  protected function createGroups($section, $groupNumbers,  $maxGroupSize, $minGroupSize)
  {
    $notFound = True;
    try {
    $sql = "SELECT * FROM grup WHERE section = '$section'";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([]);
    $results = $stmt->fetchAll();
    if(count($results) != 0)
    {
        $notFound = False;
    }

  } catch (PDOException $e) {
    echo $e->getMessage();
  }
    if($notFound)
    {
      $startGroupName = 'A';
      $asciivalue = 65;
      for($groupIndex = 0; $groupIndex < $groupNumbers; $groupIndex++)
      {
        try {
          $sql = "INSERT INTO grup(section, grupNumber,studentNumberInAGrup,
                                      minStudentCount,maxStudentCount) VALUES (?,?,?,?,?)";
          //prepare the connection for insertion
          $stmt = $this->connect()->prepare($sql);
          //execute the insertion by replacing variables
          $first = 0;
          $stmt->execute([$section, $startGroupName,$first,$minGroupSize, $maxGroupSize]);
          $asciivalue += 1;
          $startGroupName = chr($asciivalue);
          echo "here";
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
      }


      echo("added");
    }else {
      $lastGroup;
      foreach ($results as $result) {
        $lastGroup = $result["grupNumber"];
      }

      for($groupIndex = 0; $groupIndex < $groupNumbers; $groupIndex++)
      {
        try {
          $sql = "INSERT INTO grup(section, grupNumber,studentNumberInAGrup,
                                      minStudentCount,maxStudentCount) VALUES (?,?,?,?,?)";
          //prepare the connection for insertion
          $stmt = $this->connect()->prepare($sql);
          //execute the insertion by replacing variables
          $first = 0;
          $asciivalue = ord($lastGroup);
          $asciivalue += 1;
          $lastGroup = chr($asciivalue);
          $stmt->execute([$section, $lastGroup,$first,$minGroupSize, $maxGroupSize]);

          echo "here";
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
      }
    }

}

protected function deleteGroup($section, $groupNum){
    $sql = "SELECT * FROM grup WHERE section = '$section' AND grupNumber = '$groupNum'";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([]);
    $results = $stmt->fetchAll();
    if(count($results) == 0)
    {
      echo "Group could not been found";
    }else {
      $sql = "DELETE FROM grup WHERE section = '$section'  AND grupNumber = '$groupNum'";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute();

        $newGroupNumber = "0";

        $sql = "UPDATE student SET group_number = '$newGroupNumber' WHERE section = '$section' AND group_number = '$groupNum'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
  }
}


protected function addStudentToAGroup($studentID, $section, $groupNum){
    $sql = "SELECT * FROM grup WHERE section = '$section' AND grupNumber = '$groupNum'";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([]);
    $results = $stmt->fetchAll();
    $sql = "SELECT * FROM student WHERE studentID = '$studentID' AND section = '$section'";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([]);
    $resultStu = $stmt->fetchAll();
    if(count($results) == 0)
    {
      echo "There is no Group";
    }else if(count($resultStu) == 0)
    {
      echo "There is no student with this id in this section";
    }
    else{
      if($results[0]["studentNumberInAGrup"] < $results[0]["maxStudentCount"])
      {
        $newStudentNumber = $results[0]["studentNumberInAGrup"] + 1;
        $sql = "UPDATE grup SET studentNumberInAGrup = '$newStudentNumber' WHERE section = '$section' AND grupNumber = '$groupNum'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $sql = "UPDATE student SET group_number = '$groupNum' WHERE studentID = '$studentID'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        echo "<meta http-equiv='refresh' content='0'>";
      }else {
        echo "The student limit of group is full";
      }


    }
}

protected function insertChangeRequest($stuID, $state, $targetGroup)
{
  $sql = "INSERT INTO group_request(student_id, state, target_group) VALUES (?,?,?)";
  //prepare the connection for insertion
  $stmt = $this->connect()->prepare($sql);
  //execute the insertion by replacing variables
  $stmt->execute([$stuID, $state,$targetGroup]);
}


  protected function changeGroupRequest($studentID, $groupNum)
  {
      $sql = "SELECT * FROM student WHERE studentID = '$studentID'";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([]);
      $resultStu = $stmt->fetchAll();
      $sectionStudent = $resultStu[0]["section"];
      $groupNumOld = $resultStu[0]["group_number"];

      $sql = "SELECT * FROM grup WHERE section = '$sectionStudent' AND grupNumber = '$groupNum'";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([]);
      $resultGroup = $stmt->fetchAll();

      if(count($resultGroup) == 0)
      {
        echo "There is no such group";
        $failed = 2;
        $sql = "UPDATE group_request SET state = '$failed' WHERE student_id = '$studentID'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
      }else if($resultGroup[0]["maxStudentCount"] <= $resultGroup[0]["studentNumberInAGrup"])
      {
        echo "There is no place";
        $full = 3;
        $sql = "UPDATE group_request SET state = '$full' WHERE student_id = '$studentID'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
      }else {
        $accepted = 4;
        $sql = "UPDATE group_request SET state = '$accepted' WHERE student_id = '$studentID'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $sql = "SELECT * FROM grup WHERE section = '$sectionStudent' AND grupNumber = '$groupNumOld'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([]);
        $resultOldGroup = $stmt->fetchAll();

        $studentCountBefore = $resultOldGroup[0]["studentNumberInAGrup"] - 1;
        $sql = "UPDATE grup SET studentNumberInAGrup = '$studentCountBefore' WHERE section = '$sectionStudent' AND grupNumber = '$groupNumOld'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $targetGroupCount = $resultGroup[0]["studentNumberInAGrup"] + 1;
        $sql = "UPDATE grup SET studentNumberInAGrup = '$targetGroupCount' WHERE section = '$sectionStudent' AND grupNumber = '$groupNum'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $sql = "UPDATE student SET group_number = '$groupNum' WHERE studentID = '$studentID'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
      }

  }

  protected function closeCourse()
  {
    $idOfTable = 1;
    $allDeleted = True;
    $sql = "SELECT * FROM artifact";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([]);
    $artifacts = $stmt->fetchAll();
    foreach($artifacts as $artifact)
    {
      $artifactID = $artifact["id"];
      $sql = "DELETE FROM artifact WHERE id = '$artifactID'";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute();
    }
  }

  protected function denyChangeRequest($studentID, $groupNum)
  {
      $deny = 1;
      $sql = "UPDATE group_request SET state = '$deny' WHERE student_id = '$studentID'";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute();
  }

  protected function getGroupRequest()
  {
    $stateZero = 0;
    $sql = "SELECT * FROM group_request WHERE state = '$stateZero' LIMIT 1";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([]);
    $resultStu = $stmt->fetchAll();
    return $resultStu;
  }

  protected function shuffle($sectionNumber)
  {
    $NoGroupNumber = "0";
    $NoStudentInGroup = 0;
    $sql = "SELECT * FROM student WHERE group_number = '$NoGroupNumber' AND section = '$sectionNumber'";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([]);
    $studentWithoutGroup = $stmt->fetchAll();
    $numberOfStudentWithoutGroup = count($studentWithoutGroup);

    $sql = "SELECT * FROM grup WHERE section = '$sectionNumber'";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([]);
    $allGroups = $stmt->fetchAll();

    $sql = "SELECT * FROM student WHERE section = '$sectionNumber'";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([]);
    $sections= $stmt->fetchAll();

    if(count($sections) > 0)
    {
    if($numberOfStudentWithoutGroup > 0 && count($allGroups) > 0)
    {
    foreach($allGroups as $oneGroup)
    {
      $groupCountAdded = $oneGroup["studentNumberInAGrup"];
      for($indexGroups = 0;  $indexGroups < $oneGroup["minStudentCount"] - $oneGroup["studentNumberInAGrup"]; $indexGroups++)
      {
        if($numberOfStudentWithoutGroup <= 0)
        {
          break;
        }else if($studentWithoutGroup[$numberOfStudentWithoutGroup - 1]["section"] != $oneGroup["section"]){
        }else {

          $targetGroupNum = $oneGroup["grupNumber"];
          $stuId = $studentWithoutGroup[$numberOfStudentWithoutGroup - 1]["studentID"];

          $sql = "UPDATE student SET group_number = '$targetGroupNum' WHERE studentID = '$stuId'";
          $stmt = $this->connect()->prepare($sql);
          $stmt->execute();

          $groupCountAdded += 1;
          $groupID = $oneGroup["id"];
          $sql = "UPDATE grup SET studentNumberInAGrup = '$groupCountAdded' WHERE id = '$groupID' AND section = '$sectionNumber'";
          $stmt = $this->connect()->prepare($sql);
          $stmt->execute([]);


          $numberOfStudentWithoutGroup -= 1;
        }
      }
      }
      if($numberOfStudentWithoutGroup > 0)
      {
        while($numberOfStudentWithoutGroup / $allGroups[0]["minStudentCount"] > 0)
        {
          $this->createGroups($sectionNumber, 1, $allGroups[0]["minStudentCount"], $allGroups[0]["maxStudentCount"]);
          $sql = "SELECT * FROM grup WHERE studentNumberInAGrup = '$NoStudentInGroup' AND section = '$sectionNumber'";
          $stmt = $this->connect()->prepare($sql);
          $stmt->execute([]);
          $newGroup = $stmt->fetchAll();
          $groupStudentIndex = 0;
          while($groupStudentIndex < $allGroups[0]["minStudentCount"])
          {
            $this->addStudentToAGroup($studentWithoutGroup[$numberOfStudentWithoutGroup - 1]["studentID"],
                  $sectionNumber, $newGroup[0]["grupNumber"]);
            $groupStudentIndex++;
          }
          $numberOfStudentWithoutGroup -= $allGroups[0]["minStudentCount"];
        }

        if($numberOfStudentWithoutGroup > 0)
        {
          unset($allGroups);
          $sql = "SELECT * FROM grup WHERE section = '$sectionNumber'";
          $stmt = $this->connect()->prepare($sql);
          $stmt->execute([]);
          $allGroupsUpdated = $stmt->fetchAll();
          foreach($allGroupsUpdated as $groupToFill)
          {
            if($numberOfStudentWithoutGroup == 0)
            {
              break;
            }else if($groupToFill["studentNumberInAGrup"] < $groupToFill["maxStudentCount"])
            {
              $firstNumberOfStudentInTheGroup = $groupToFill["studentNumberInAGrup"];
              while($firstNumberOfStudentInTheGroup < $groupToFill["maxStudentCount"])
              {
                $this->addStudentToAGroup($studentWithoutGroup[$numberOfStudentWithoutGroup - 1]["studentID"],
                      $sectionNumber, $groupToFill[0]["grupNumber"]);
                $numberOfStudentWithoutGroup--;
                $firstNumberOfStudentInTheGroup++;
                if($numberOfStudentWithoutGroup == 0)
                {
                  break;
                }
              }

            }
          }
        }
      }

    }

  }else {
      echo "There is no student in that section";
  }
  }

  //Return all student from database
  //@return  results -> the array containing the all students
  protected function getAllGroups()
  {
    $sql = "SELECT * FROM grup";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([]);
    //put all table entries into an array
    $results = $stmt->fetchAll();
    return $results;  //return the array
  }
}
 ?>
