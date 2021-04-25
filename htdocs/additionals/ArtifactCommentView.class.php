<?php

/*
Studentview class
View part of the MVC architecture
*/
class ArtifactCommentView extends ArtifactComment{

//display all the artifacts
public function showArtifactComments()
{
  $results = $this->getArtifactComments();
  echo "<table border='1'>
  <tr>
  <th>GroupName</th>
  <th>ArtifactName</th>
  <th>AuthorID</th>
  <th>Date</th>
  <th>Comment</th>
  </tr>";
  foreach ($results as $artifactcomment)
  {
    echo "<tr>";
    echo "<td>" . $artifactcomment['group_num'] . "</td>";
    echo "<td>" . $artifactcomment['artifact_name'] . "</td>";
    echo "<td>" . $artifactcomment['author_id'] . "</td>";
    echo "<td>" . $artifactcomment['date_of_submission'] . "</td>";
    echo "<td>" . $artifactcomment['comment'] . "</td>";
    echo "</tr>";
  }

echo "</table>";
}

//display artifacts by group
//@param $groupNum the group number
public function showArtifactCommentsByGroup($groupNum)
{
  $results = $this->getArtifactsByGroup($groupNum);
  echo "<table border='1'>
  <tr>
  <th>GroupName</th>
  <th>ArtifactName</th>
  <th>AuthorID</th>
  <th>Date</th>
  <th>Comment</th>
  </tr>";
  foreach ($results as $artifactcomment)
  {
    echo "<tr>";
    echo "<td>" . $artifactcomment['group_num'] . "</td>";
    echo "<td>" . $artifactcomment['artifact_name'] . "</td>";
    echo "<td>" . $artifactcomment['author_id'] . "</td>";
    echo "<td>" . $artifactcomment['data_of_submission'] . "</td>";
    echo "<td>" . $artifactcomment['comment'] . "</td>";
    echo "</tr>";
  }

echo "</table>";
}
//display artifacts by name
//@param $artifactName the name of the artifact
public function showArtifactCommentsByName($artifactName)
{
  $results = $this->getArtifactsByName($artifactName);
  echo "<table border='1'>
  <tr>
  <th>GroupName</th>
  <th>ArtifactName</th>
  <th>AuthorID</th>
  <th>Date</th>
  <th>Comment</th>
  </tr>";
  foreach ($results as $artifactcomment)
  {
    echo "<tr>";
    echo "<td>" . $artifactcomment['group_num'] . "</td>";
    echo "<td>" . $artifactcomment['artifact_name'] . "</td>";
    echo "<td>" . $artifactcomment['author_id'] . "</td>";
    echo "<td>" . $artifactcomment['data_of_submission'] . "</td>";
    echo "<td>" . $artifactcomment['comment'] . "</td>";
    echo "</tr>";
  }

echo "</table>";
}


}
