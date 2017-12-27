<?php
namespace Nsallsliders\NsAllSliders\ViewHelpers;
class YesnoViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
	/**
	* @param string $myvalue
	*/
	public function render($myvalue) {
		$content = '';
		$res=explode(' ', $myvalue);
		if($res[1]=='_blank'){
			$content='_blank';
		}else if($res[1]=='_top'){
			$content='_top';
		}
		else{
			$content="";
		}
		return $content;
	}
}
?>