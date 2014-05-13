<?php
define("SYSTEM_CHARCODE", "UTF-8");
define("ERRORMAIL_FROM", "admin@awiec.com");
define("ERRORMAIL_TO", "");
define("ERRORMAIL_CC", "");
define("ERRORMAIL_BCC", "mamamode@hotmail.co.jp, fsw5800b@gmail.com");
//define("ERRORMAIL_BCC", "mamamode@hotmail.co.jp");


class LoadAverageChecker {
	private $checkList;
	private $errorList;
	
	const NOTICE1 = '0.00';
	const NOTICE2 = '5.00';
	
	public function __construct(){
		mb_language("japanese");
		mb_internal_encoding(SYSTEM_CHARCODE);
		
		$this->errorList = array();
		}
	public function process(){
		$this->check();
	}
	private function check(){	
		$loadave = exec('uptime');
		preg_match_all('/[0-9]{1,3}\.[0-9]{2}/', $loadave, $match);
		$one_minute = $match[0][0] * 100;
		$five_minute = $match[0][1] * 100;
		$fifteen_minute = $match[0][2] * 100;
		if($one_minute > LoadAverageChecker::NOTICE2 * 100) {
			$this->sendErrorMail(LoadAverageChecker::NOTICE2, $loadave);
		} else if($one_minute > LoadAverageChecker::NOTICE1 * 100) {
			$this->sendErrorMail(LoadAverageChecker::NOTICE1, $loadave);
		}	
	}
	private function sendErrorMail($notice, $loadaverage){
		$hostname = exec("/bin/hostname");
		
		$header="From: ".ERRORMAIL_FROM;
		$header.="\n";
		$header.="Cc: ".ERRORMAIL_CC;
		$header.="\n";
		$header.="Bcc: ".ERRORMAIL_BCC;		
		$additionalParameter = '-f '.ERRORMAIL_FROM;
		$body = $hostname."のロードアベレージが ".$notice." を超えました\n ";
		$body .= "uptime の実行結果を以下に表示します。\n\n";
		$body .= $loadaverage;
		
		mb_send_mail(ERRORMAIL_TO, $hostname . 'の負荷通知', $body, $header, $additionalParameter);
	}
	
}
?>
