<?php
/*
ArtifactController class
Controller part of the MVC architecture
*/
class ArtifactController extends Artifact
{

    //a function that calls model class insert method
    //@parameter $artifactName name of the artifact
    //@parameter $grouNum the number of the group that the artifact belongs
    //@paratemeter $link the link to the artifact
    public function uploadArtifact($name, $groupNum, $link)    {
      $this->insertArtifactToDB($name, $groupNum, $link);
    }

    //a function to delete a specifed artifact
    //@parameter $artifactName name of the artifact
    //@parameter $grouNum the number of the group that the artifact belongs
    public function deleteArtifact( $name, $groupNum)
    {
      $this->deleteArtifact($name,$groupNum);
    }

    //a function that returns all artifacts beelonging to a group
    //@param groupNum the group Number
    //@return all artifacts as an associative array
    public function getArtifactByGroup($groupNum)
    {
      return $this->getArtifactsByGroup($groupNum);
    }
    
    public function getArtifactByGroupAndName($groupNum, $artifactName)
    {
      return $this->getArtifactsByGroupAndName($groupNum,$artifactName);
    }
}
