<?php

class yapf_Captcha
{
	var $chars = '1234567890abcdefghijklmnopqrstuvwxyz';

	public function __construct($length = 6, $width = 360, $height = 90){
		for($i = 0; $i < $length; $i++){
		   $pos = mt_rand(0, strlen($this->chars)-1);
		   $this->code .= substr($this->chars, $pos, 1);
		}
	}

	public function render(){
		// prevent caching
		header('Expires: Tue, 08 Oct 1991 00:00:00 GMT');
		header('Cache-Control: no-cache, must-revalidate');
		 
		// output the image
		header("Content-Type: image/gif");
		imagegif($this->image);
		imagedestroy($this->image); 
	}
}