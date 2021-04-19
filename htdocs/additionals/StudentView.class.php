<?php

/*
Studentview class
View part of the MVC architecture
*/
class studentView extends Student{

public function showStudents()
{
  $results = $this->getStudents();
  foreach ($results as $user) {
    echo "Name: " . $user["name"] . "\t" . "Section" .$user["section"];
}
}
}
