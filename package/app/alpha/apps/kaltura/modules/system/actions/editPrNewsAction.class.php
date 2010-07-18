<?php
require_once ( "model/genericObjectWrapper.class.php" );
require_once ( "kalturaSystemAction.class.php" );

class editPrNewsAction extends kalturaSystemAction
{
	public function execute()
	{

		$this->forceSystemAuthentication();

		$path =  "/content/static/press/logos/";
		$this->path = $path;

		$mode = $this->getRequestParameter( "mode" , null );

		$add_list = true;

		if ( $mode == "add" || $mode == "modify" )
		{
			if ( $mode == "modify" )
			{
				$id = 	$this->getRequestParameter( "id");
				$news = PrNewsPeer::retrieveByPK( $id );
			}
			else
			{
				$news = new PrNews();
			}
			
			$news->setText ( $this->getRequestParameter( "text") );
			$news->setHref ( $this->getRequestParameter( "href") );
			$news->setPressDate( $this->getRequestParameter( "press_date") );
			$news->setAlt ( $this->getRequestParameter( "alt") );
			$order = $this->getRequestParameter( "pr_order" , null );
				
			$news->save();

			$id= $news->getId();

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
				
				$news->setImagePath( $image_path );
			}
			
			if ( $order)
			{
				$news->setPrOrder( $order );
			}
			else
			{
				$news->setPrOrder( $id * 10 );
			}
			
			$news->save();
				
		}
		else if ( $mode == "delete" )
		{
			$news_id = $this->getRequestParameter( "news_id");
			$news = PrNewsPeer::retrieveByPK( $news_id );

			if ( $news )
			{
				$news->delete();
			}
			$add_list = false;
				
			return $this->renderText( "Deleted $news_id");
		}

		if ( $add_list )
		{
			$c = new Criteria();
			$c->addDescendingOrderByColumn( PrNewsPeer::PR_ORDER );
			$this->news_list = PrNewsPeer::doSelect ($c) ;
		}
	}

}
?>