<?php

class metacafeRedirectAction extends kalturaAction
{
	public function execute()
	{
		$error = false;
		
		// metacafe video id
		$itemId = $this->getRequestParameter("itemId");
		
		$url = "http://www.metacafe.com/api/item/" . $itemId;
		$content = kFile::downloadUrlToString($url);
		
		$doc = new DOMDocument();
		if ($doc->loadXML($content))
		{
			$xpath = new DOMXPath($doc);
			$itemNodes = $xpath->query("//item");

			if (!$itemNodes->length)
			{
				$error = true;
			}
			else
			{
				$itemNode = $itemNodes->item(0);

				$ns = "http://search.yahoo.com/mrss/";
				$swfUrl = self::getXmlNodeValue($itemNode, "content", "url", $ns);
				
				// get only the headers and don't follow the location redirect
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $swfUrl);
				curl_setopt($ch, CURLOPT_USERAGENT, "curl/7.11.1");
				curl_setopt($ch, CURLOPT_HEADER, 1);
				curl_setopt($ch, CURLOPT_NOBODY, 1);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
				$headers = curl_exec($ch);
				
				// get the location header
				$found1 = preg_match('/Location: (.*?)$/ms', $headers, $swfUrlResult);
				$swfUrl = $swfUrlResult[1];
				$found2 = preg_match('/mediaURL=(.*?)&/ms', $swfUrl, $flvResult);
				$flv = $flvResult[1];
				$flv = urldecode($flv);
				$found3 = preg_match('/gdaKey=(.*?)&/ms', $swfUrl, $keyResult);
				$flv = $flv . "?__gda__=" . $keyResult[1];
				
				$this->redirect($flv);
			}
		}
		else
		{
			$error = true;
		}

		if ($error)
			die("File not found");
	}
	
	private static function getXmlNodeValue($element, $nodeName, $attrName = null, $ns = null)
	{
		if ($ns)
			$titleNodes = $element->getElementsByTagNameNS($ns, $nodeName);
		else
			$titleNodes = $element->getElementsByTagName($nodeName);
		
		if ($titleNodes->length)
		{
			$node = $titleNodes->item(0);
			
			return $attrName ? $node->getAttribute($attrName) : $node->nodeValue;
		}
		return "";
	}
}
