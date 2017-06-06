<?php

namespace Blog\Pages;

class Captcha extends Basicpage {
	public function render() {
		$captcha = new \Captcha\Captcha();
		$captcha->showImage();
	}
}