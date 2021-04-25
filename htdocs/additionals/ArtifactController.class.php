<?php
/*
StudentController class
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
}
