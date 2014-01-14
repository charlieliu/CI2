<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// 載入html使用的相關檔案
if(!function_exists('load_html_file'))
{
	function load_html_file($link)
	{
		$html = '';
		if( isset($link['href']) && !empty($link['href']) )
		{
			$file_type = strtolower(pathinfo($link['href'],PATHINFO_EXTENSION));
			switch($file_type)
			{
				case'js':
					$html = '<script type="text/javascript" src="'.$link['href'];
					if( isset($link['ver']) && !empty($link['ver']) )
					{
						$html .= '?'.$link['ver'];
					}
					$html .= '"></script>';
					break;
				case'css':
					$html = '<link';
					if( isset($link['rel']) && !empty($link['rel']) )
					{
						$html .= ' rel="'.$link['rel'].'"';
					}
					else
					{
						$html .= ' rel="stylesheet"';
					}
					if( isset($link['type']) && !empty($link['type']) )
					{
						$html .= ' type="'.$link['type'].'"';
					}
					else
					{
						$html .= ' type="text/css" ';
					}
					$html .= ' href="'.$link['href'];
					if( isset($link['ver']) && !empty($link['ver']) )
					{
						$html .= '?'.$link['ver'];
					}
					$html .= '" />';
					break;
				default:
					if( isset($link['type']) && $link['type']=='image/x-icon' )
					{
						$html = '<link rel="shortcut icon" type="image/x-icon" href="'.$link['href'].'" />';
					}
					break;
			}
		}
		return $html;
		
	}

}

?>