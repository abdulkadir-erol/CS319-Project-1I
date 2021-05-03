<?php
/*
ArtifactController class
Controller part of the MVC architecture
*/
class ArtifactCommentController extends ArtifactComment
{

    //a function that calls model class insert method
    //@parameter $artifactName name of the artifact
    //@parameter $grouNum the number of the group that the artifact belongs
    //@parameter $comment comment made to the artifact
    //@parameter $date the date which the review is submitted
    //@paramter $authorID the ID of writer of the comment
    public function uploadArtifactComment($comment ,$groupNum,
                                $authorID, $date, $artifactName)    {
      $this->insertArtifactCommentToDB($comment ,$groupNum,
                                  $authorID, $date, $artifactName);
    }

    //a function to delete a specifed artifact comment
    //@parameter $artifactName name of the artifact
    //@parameter $grouNum the number of the group that the artifact belongs
    public function deleteArtifactComments( $artifactName, $groupNum)
    {
      $this->deleteArtifactComment( $artifactName, $groupNum);
    }
}
