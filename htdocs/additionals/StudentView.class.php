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
public function showStudentsByGroup($groupNum, $section)
{

    $results = $this->getStudentsByGroup($groupNum, $section);
    echo "<table align='center'>
      <tr>
      <th>Name</th>
      <th>Student ID</th>
      <th>GroupNumber</th>
      <th>Section</th>
      </tr>";
        foreach ($results as $user)
      {
        echo "<tr>";
        echo "<td align='center' style='border:1px solid trader_cdl3blackcrows; font-size:18; '>" . $user['name'] . "</td>";
        echo "<td align='center'style='border:1px solid black; font-size:18; '>" . $user['studentID'] . "</td>";
        echo "<td align='center'style='border:1px solid black; font-size:18; '>" . $user['group_number']. "</td>";
        echo "<td align='center'style='border:1px solid black; font-size:18; '>" . $user['section']. "</td>";
        echo "</tr>";
      }
    echo "</table>";

}

public function showStudentList($sortRequest)
{
  $results = $this->getStudentWithOrder($sortRequest);

  
  echo "<table align='center'>
    <tr>
    <th>Name</th>
    <th>Student ID</th>
    <th>GroupNumber</th>
    <th>Section</th>
    </tr>";
      foreach ($results as $user)
    {
      $text = wordwrap($user['name'] , 15, "\n",true);
      echo "<tr>";

     echo "<td align='center' style='border:1px solid trader_cdl3blackcrows; font-size:18; '>" . $text . "</td>";
      echo "<td align='center'style='border:1px solid black; font-size:18; '>" . $user['studentID'] . "</td>";
      echo "<td align='center'style='border:1px solid black; font-size:18; '>" . $user['group_number']. "</td>";
      echo "<td align='center'style='border:1px solid black; font-size:18; '>" . $user['section']. "</td>";
      echo "</tr>";
    }
  echo "</table>";
}
}
