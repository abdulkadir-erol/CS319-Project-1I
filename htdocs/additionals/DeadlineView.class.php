<?php

/*
DeadlineView class
View part of the MVC architecture
*/
class DeadlineView extends Deadline{

//display all the student comment written about a student
public function showAllDeadlines()
{
  $results = $this->getDeadlines();
  echo "<table border =1 style='border-collapse: collapse'>
  <tr>
  <th>Name</th>
  <th>Deadline</th>
  </tr>";
  foreach ($results as $deadline)
  {
    echo "<tr>";
    echo "<td>" . $deadline['artifact_name'] . "</td>";
    echo "<td>" . $deadline['date'] . "</td>";
    echo "</tr>";
  }

echo "</table>";
}
}
