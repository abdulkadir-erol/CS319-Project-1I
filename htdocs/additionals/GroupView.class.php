<?php

/*
Studentview class
View part of the MVC architecture
*/
class GroupView extends Group{

//display all the artifacts
public function getGroupRequests()
{
  return $this->getGroupRequest();

}

public function showAllGroups()
{
  $results = $this->getAllGroups();
  echo "<table align='center'>
    <tr>
    <th>Section</th>
    <th>Group Number</th>
    <th>Current Student Count</th>
    <th>Max Student Count</th>
    </tr>";
      foreach ($results as $user)
    {
      echo "<tr>";
      echo "<td align='center' style='border:1px solid trader_cdl3blackcrows; font-size:18; '>" . $user['section'] . "</td>";
      echo "<td align='center'style='border:1px solid black; font-size:18; '>" . $user['grupNumber'] . "</td>";
      echo "<td align='center'style='border:1px solid black; font-size:18; '>" . $user['studentNumberInAGrup']. "</td>";
      echo "<td align='center'style='border:1px solid black; font-size:18; '>" . $user['maxStudentCount']. "</td>";
      echo "</tr>";
    }
  echo "</table>";
}
}
