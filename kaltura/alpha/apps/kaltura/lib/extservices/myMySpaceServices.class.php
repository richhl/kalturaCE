<?php
class myMySpaceServices extends myBaseMediaSource implements IMediaSource
{
	protected $supported_media_types =  self::SUPPORT_MEDIA_TYPE_VIDEO ;  
	protected $source_name = "MySpace";
	protected $auth_method = array ( self::AUTH_METHOD_PUBLIC ,  self::AUTH_METHOD_USER_PASS );
	protected $search_in_user = true; 
	protected $logo = "http://www.kaltura.com/images/wizard/logo_myspace.png";
	protected $id = entry::ENTRY_MEDIA_SOURCE_MYSPACE;
		
	private static $NEED_MEDIA_INFO = "1";
		
	const USER_AGENT = "User-Agent: curl/7.11.1 (i686-pc-cygwin) libcurl/7.11.1 OpenSSL/0.9.7g zlib/1.2.2";
	
	public function getMediaInfo( $media_type ,$objectId) 
	{
		if( $media_type == entry::ENTRY_MEDIA_TYPE_VIDEO )
		{
			return self::getObjectInfo( $objectId );
		}
		else
		{
			// this provider does not supply media type $media_type
		}		
		return null;		
	}
	
	public function searchMedia( $media_type , $searchText, $page, $pageSize, $authData = null, $extraData = null)
	{
		if( $media_type == entry::ENTRY_MEDIA_TYPE_VIDEO )
		{
			return self::searchVideos(  $searchText, $page, $pageSize, $authData );
		}
		else
		{
			// this provider does not supply media type $media_type
		}		
		return null;		
		
	}	
	
	public function getAuthData($kuserId, $userName, $password, $token)
	{
		//curl -c cookie_file -d "NextPage=fuseaction=user&email=USER@XYZ.COM&password=PASSWORD" "http://login.myspace.com/index.cfm?fuseaction=login.process"
		//curl -b cookie_file "http://vids.myspace.com/index.cfm?fuseaction=vids.myVideos"
		
		$postData = array("NextPage" => "fuseaction=user", "email" => $userName, "password" => $password);

		/*
		$o="";
		foreach ($postData as $k => $v)
			$o.= "$k=".utf8_encode($v)."&";
		$postData = substr($o,0,-1);
		*/
		
		$loginUrl = "http://login.myspace.com/index.cfm?fuseaction=login.process";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $loginUrl);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		curl_setopt($ch, CURLOPT_USERAGENT, self::USER_AGENT);
		curl_setopt($ch, CURLOPT_HEADER, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER , TRUE);
		
		$response = curl_exec($ch);
		curl_close($ch);

		//print($header);

		$status = 'error';
		$message = '';
		$authData = null;
		
		if (preg_match('/Set-Cookie: (MYUSERINFO=[^;].*?);/', $response, $sessionCookieMatch))
		{
			$status = 'ok';
			$authData = base64_encode(trim($sessionCookieMatch[1]));
		}
		
		return array('status' => $status, 'message' => $message, 'authData' => $authData );
	}

	
	/*
	 public static function login($userName, $password)
	 {
		//curl -c cookies.txt -D headers.txt -o login.txt -d "action=login&redir=&username=USERNAME&password=PASSWORD&login=Login" http://photobucket.com/login.php
		$postData = array("action" => "login", "redir", "username" => $userName, "password" => $password, "login" => "Login");

		$o="";
		foreach ($postData as $k=>$v)
		$o.= "$k=".utf8_encode($v)."&";

		$postData = substr($o,0,-1);

		$loginUrl = "http://photobucket.com/login.php";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $loginUrl);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		curl_setopt($ch, CURLOPT_HEADER, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER , TRUE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

		$header = curl_exec($ch);
		curl_close($ch);

		if (preg_match('/Set-Cookie:.*?(PHPSESSID.*?);/', $header, $sessionCookieMatch))
		{
		$sessionCookie = $sessionCookieMatch[1];
		return $sessionCookie;
		}
		else
		{
		return "";
		}
		}
		*/

	private  static function search($searchText, $page)
	{
		$url = "http://vids.myspace.com/index.cfm?fuseaction=vids.search&q=$searchText&page=".($page - 1);
		//$url = "http://vidsearch.myspace.com/index.cfm?fuseaction=vids.fullsearch";
		//$postData = "page=$page&t=".$searchText."&orderby=1&limit=1";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);

		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_NOBODY, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER , TRUE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

		$content = curl_exec($ch);
		curl_close($ch);

		return $content;
	}

	private  static function parse($content, $tableRegex)
	{
		/*
		 <tr>
			<td class="still">
			<a class="still" href="/index.cfm?fuseaction=vids.individual&videoid=7648935">
			<img width="120" height="90" src="http://myspace-562.vo.llnwd.net/02019/26/50/2019350562_thumb1.jpg"/>
			</a>
			</td>
			<td class="summary">
			<div class="rating">
			Rating:
			<strong>90%</strong>
			</div>
			<h2 class="title">
			<a href="/index.cfm?fuseaction=vids.individual&videoid=7648935">Timmy and the Sun</a>
			</h2>
			<div class="text">
			<span>
			<strong>0:17</strong>
			</span>
			</div>
			<div class="description" wbr="true">Timmy and the Sun</div>
			<div class="text">
			Categories:
			<a href="/index.cfm?fuseaction=vids.charts&category=4">Comedy and Humor</a>
			<br/>
			Tags:
			<a href="/index.cfm?fuseaction=vids.search&t=Sun">Sun</a>
			<br/>
			Added:
			<span>3 months ago</span>
			<br/>
			By:
			<a href="/index.cfm?fuseaction=vids.channel&ChannelID=42960487">Peter Anderson</a>
			<br/>
			Plays:
			<span>4,381</span>
			| Comments:
			<span>10</span>
			</div>
			</td>
			</tr>
		 */
		$images = array();
		$message = '';

		// analyze search page thumbnails
		if (preg_match($tableRegex, $content, $containerTag))
		{
			if (preg_match_all('/<tr>(.*?)<\/tr>/ms', $containerTag[1], $entryContainers))
			{
				foreach($entryContainers[1] as $entryContainer)
				{
					$title = "";
					$videoId = "";
		
					if (preg_match('/<h2 class="title">.*?<a.*?videoid=(\d+).*?>(.*?)<\/a>/is', $entryContainer, $titleTag))
					{
						$videoId = $titleTag[1];
						$title = $titleTag[2];
					}

					$duration = "";
					if (preg_match('/<div class="text">.*?<span><strong>(.*?)<\/strong><\/span>.*?<\/div>/is', $entryContainer, $durationTag))
					{
						$duration = $durationTag[1];
					}

					$thumbnail = "";
					$videoFlvId = "";
					if (preg_match('/<img src="(.*?)".*?>/', $entryContainer, $imgTag))
					{
						$thumbnail = $imgTag[1];
					}

					$images[] = array('thumb' => $thumbnail,
						'title' => $title, 
						'description' => "($duration secs) $title",
						'id' => $videoId);
				}
			}

			$status = "ok";
		}
		else
		{
			$status = "error";
		}

		return array('status' => $status, 'message' => $message, 'objects' => $images , "needMediaInfo" => self::$NEED_MEDIA_INFO);
	}

		
	private static function getObjectInfo($objectId)
	{
		$htmlPage = kFile::downloadUrlToString("http://vids.myspace.com/index.cfm?fuseaction=vids.individual&videoid=$objectId");
		
		$status = 'error';
		$message = '';
		$objectInfo = null;

		$title = '';
		$tags = '';
		$flvUrl = '';

		if (preg_match('/<h1.*?>(.*?)<\/h1>/', $htmlPage, $titleTag))
		{
		
			$title = $titleTag[1];

			if (preg_match('/<div.*?>.*?Tags:(.*?)<\/div>/ms', $htmlPage, $tagsContainer))
			{
				if (preg_match_all('/<a href.*?>(.*?)<\/a>/ms', $tagsContainer[1], $tagsWords))
				{
					$tags = implode(',', $tagsWords[1]);
				}
			}

			$rssFeed = kFile::downloadUrlToString("http://mediaservices.myspace.com/services/rss.ashx?type=video&videoID=$objectId");
			if (preg_match_all('/<media:content url="(.*?)"/ms', $rssFeed, $urlAttr))
			{
				$flvUrl = $urlAttr[1][0];
			}
			/*
			else
			{
				$len = strlen($videoFlvId);
				$flvUrl = sprintf("http://content.movies.myspace.com/%07d/%s%s/%s%s/%d.flv",
				floor($videoFlvId / 100000), $videoFlvId[--$len], $videoFlvId[--$len],
				$videoFlvId[--$len], $videoFlvId[--$len], $videoFlvId);
			}
			*/

			$objectInfo = array('id' => $objectId, 'title' => $title,
				'url' => $flvUrl,
				'tags' => $tags,
				'license' => '', 'credit' => '');

				$status = 'ok';
		}

		return array('status' => $status, 'message' => $message, 'objectInfo' => $objectInfo);
	}



	
	private  static function searchVideos($searchText, $page, $pageSize, $authData = null)
	{
		$searchText = str_replace(' ', '+', $searchText);
		if ($authData)
		{
			$result = self::searchYourOwn($searchText, $page, $pageSize, $authData);
			return self::parse($result, '/<table class="myUploadsList">(.*?)<\/table>/ms');
		}
		else
		{
			$result = self::search($searchText, $page);
			return self::parse($result, '/<table id="search_results">(.*?)<\/table>/ms');
		}
	}


	
	private static function searchYourOwn($searchText, $page, $pageSize, $authData)
	{
		$authData = base64_decode($authData);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://vids.myspace.com/index.cfm?fuseaction=vids.myVideos&page=".($page - 1));
		curl_setopt($ch, CURLOPT_USERAGENT, self::USER_AGENT);
		curl_setopt($ch, CURLOPT_COOKIE, $authData);
		curl_setopt($ch, CURLOPT_HEADER, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER , TRUE);

		$body = curl_exec($ch);
		curl_close($ch);
		
		return $body;
	}
}
?>