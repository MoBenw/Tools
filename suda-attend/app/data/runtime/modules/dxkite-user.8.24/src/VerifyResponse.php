<?php
namespace dxkite\user\response;
use dxkite\support\visitor\response\Response;
use dxkite\support\visitor\Context;
use dxkite\user\manager\CodeManager;

class VerifyResponse extends Response {
    public function onVisit(Context $context) {
        $this->type('png');
        $this->etag('code.'.microtime(true));
        CodeManager::display();
    }
}