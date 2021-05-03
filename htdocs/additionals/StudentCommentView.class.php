<style>
    .outside-while{
        border:1px solid black;font-size:18;font-weight:bold;
    }

    .inside-while{
        border:1px solid black;
    }
</style>

<?php

/*
Studentview class
View part of the MVC architecture
*/
class StudentCommentView extends StudentComment{

//display all the student comment written about a student
public function showStudentCommentsByTargetID($studentID)
{
  $results = $this->getStudentCommentsByTargetID($studentID);
  
  echo "<table>
  <tr>
  <th>Contribution</th>
  <th>Participation</th>
  <th>Communication</th>
  <th>Knowledge</th>
  <th width >Submission Date</th>
  <th>Comment</th>
  </tr>";
  foreach ($results as $studentcomment)
  {
    $text = wordwrap($studentcomment['comment'] , 65, "\n",true);
    echo "<tr>";
    echo "<td style='text-align: center;'>" . $studentcomment['contribution_grade'] . "</td>";
    echo "<td style='text-align: center;'>" . $studentcomment['participation_grade'] . "</td>";
    echo "<td style='text-align: center;'>" . $studentcomment['communication_grade'] . "</td>";
    echo "<td style='text-align: center;'>" . $studentcomment['knowledge_grade'] . "</td>";
    echo "<td style='text-align: center;'>" . $studentcomment['date_of_submission'] . "</td>";
    echo "<td>" . $text. "</td>";
    echo "</tr>";
  }

echo "</table>";
}
}
