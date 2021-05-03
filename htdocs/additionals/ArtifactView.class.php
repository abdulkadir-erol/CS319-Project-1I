<?php

/*
Studentview class
View part of the MVC architecture
*/
class ArtifactView extends Artifact{

//display all the artifacts
public function showArtifacts()
{
  $results = $this->getArtifacts();
  echo "<table align='center'>
  <tr>
  <th>Name</th>
  <th>GroupNumber</th>
  <th>Link</th>
  </tr>";
  foreach ($results as $artifact)
  {
    echo "<tr>";
    echo "<td align='center' style='border:1px solid black; font-size:18; font-weight:bold'>" . $artifact['name'] . "</td>";
    echo "<td align='center'style='border:1px solid black; font-size:18; font-weight:bold'>" . $artifact['group_number'] . "</td>";
    echo "<td align='center'style='border:1px solid black; font-size:18; font-weight:bold'>" . '<a target=\"_blank\" href='.$artifact["link"] . '>View Artifact</a>' . "</td>";
    echo "</tr>";
  }
echo "</table>";
}

//display artifacts by group
//@param $groupNum the group number
public function showArtifactsByGroup($groupNum)
{
  $results = $this->getArtifactsByGroup($groupNum);
  echo "<table align='center'>
  <tr>
  <th>Name</th>
  <th>GroupNumber</th>
  <th>Link</th>
  </tr>";
  foreach ($results as $artifact)
  {
    echo "<tr>";
    echo "<td align='center' style='border:1px solid trader_cdl3blackcrows; font-size:18; '>" . $artifact['name'] . "</td>";
    echo "<td align='center'style='border:1px solid black; font-size:18; '>" . $artifact['group_number'] . "</td>";
    echo "<td align='center'style='border:1px solid black; font-size:18; '>" . '<a target=\"_blank\" href='.$artifact["link"] . '>View Artifact</a>' . "</td>";
    echo "</tr>";
  }
echo "</table>";
}
//display artifacts by name
//@param $artifactName the name of the artifact
public function showArtifactsByName($artifactName)
{
  $results = $this->getArtifactsByName($artifactName);
  echo "<table border='1'>
  <tr>
  <th>Name</th>
  <th>GroupNumber</th>
  <th>Link</th>
  </tr>";
  foreach ($results as $artifact)
  {
    echo "<tr>";
    echo "<td>" . $artifact['name'] . "</td>";
    echo "<td>" . $artifact['group_number'] . "</td>";
    echo "<td>" . '<a href='.$artifact["link"] . '>View Artifact</a>' . "</td>";
    echo "</tr>";
  }

echo "</table>";
}


}
