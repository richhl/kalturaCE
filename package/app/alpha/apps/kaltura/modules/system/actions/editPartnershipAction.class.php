<?php
require_once ( "model/genericObjectWrapper.class.php" );
require_once ( "kalturaSystemAction.class.php" );

class editPartnershipAction extends kalturaSystemAction
{
	public function execute()
	{

		$this->forceSystemAuthentication();

		$path =  "/content/static/partnership/logos/";
		$this->path = $path;

		$mode = $this->getRequestParameter( "mode" , null );

		$add_list = true;

		if ( $mode == "add" || $mode == "modify" )
		{
			if ( $mode == "modify" )
			{
				$id = 	$this->getRequestParameter( "id");
				$partnership  = PartnershipPeer::retrieveByPK( $id );
			}
			else
			{
				$partnership = new Partnership();
			}
			
			$partnership->setText ( $this->getRequestParameter( "text") );
			$partnership->setHref ( $this->getRequestParameter( "href") );
			$partnership->setPartnershipDate( $this->getRequestParameter( "partnership_date") );
			$partnership->setAlt ( $this->getRequestParameter( "alt") );
			$order = $this->getRequestParameter( "partnership_order" , null );
				
			$partnership->save();

			$id= $partnership->getId();

			$origFilename = @$_FILES['Filedata']['name'];
			if ( $origFilename )
			{
				$parts = pathinfo($origFilename);
				$extension = strtolower($parts['extension']);

				$image_path = $id . "." . $extension;

				// add the file extension after the "." character
				$fullPath = myContentStorage::getFSContentRootPath() . $path .$image_path;


				myContentStorage::fullMkdir($fullPath);
				move_uploaded_file($_FILES['Filedata']['tmp_name'], $fullPath);
				chmod ( $fullPath , 0777 );
				
				$partnership->setImagePath( $image_path );
			}
			
			if ( $order)
			{
				$partnership->setPartnershipOrder( $order );
			}
			else
			{
				$partnership->setPartnershipOrder( $id * 10 );
			}
			
			$partnership->save();
				
		}
		else if ( $mode == "delete" )
		{
			$npartnership_id = $this->getRequestParameter( "partnership_id");
			$partnership = PartnershipPeer::retrieveByPK( $partnership_id );

			if ( $partnership )
			{
				$partnership->delete();
			}
			$add_list = false;
				
			return $this->renderText( "Deleted $npartnership_id");
		}

		if ( $add_list )
		{
			$c = new Criteria();
			$c->addDescendingOrderByColumn( PartnershipPeer::PARTNERSHIP_ORDER );
			$this->partnership_list = PartnershipPeer::doSelect ($c) ;
		}
	}

}
?>