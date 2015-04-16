<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";
require_once APPPATH."/third_party/PHPExcel/IOFactory.php";
require_once APPPATH."/third_party/PHPExcel/Cell.php";
require_once APPPATH."/third_party/PHPExcel/Writer/Excel2007.php";
require_once APPPATH."/third_party/PHPExcel/CachedObjectStorageFactory.php";
require_once APPPATH."/third_party/PHPExcel/Settings.php";

class Excel extends PHPExcel {
	public function __construct($params=null)
	{
		if( !is_null($params) )
		{
			$memoryCacheSize = empty($params['memoryCacheSize']) ?  : $params['memoryCacheSize'] ;
			$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
			$cacheSettings =array('memoryCacheSize'=>$memoryCacheSize.'MB',) ;
			PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings) ;
		}
		parent::__construct();
	}

	public function xls2Array($file)
	{
		$objReader = PHPExcel_IOFactory::createReaderForFile($file) ;
		$objReader->setReadDateOnly(TRUE) ;

		/**  Load $inputFileName to a PHPExcel Object  **/
		$objPHPExcel = $objReader->load($file);
		$objWorksheet = $objPHPExcel->setActiveSheet();

		foreach ($objWorksheet->getRowIterator() as $row)
		{
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(FALSE) ;
			unset($tmpAry) ;
			foreach ($cellIterator as $cell)
			{
				$v = $cell->getFormattedValue() ;
				$v = trim($v) ;
				$tmpAry[] = $v ;
			}
			$rtnAry[] = $tmpAry ;
		}
		return $rtnAry ;
	}
}
?>