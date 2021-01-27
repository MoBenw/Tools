<?php
namespace dxkite\user\response;

use dxkite\support\visitor\response\Response;
use dxkite\support\visitor\Context;
use dxkite\user\manager\UserManager;

class AvatarResponse extends Response
{
    public function onVisit(Context $context)
    {
        $userId=request()->get()->id(0);
        $fileId=UserManager::getAvatarId($userId);
        if ($fileId) {
            $this->go(u('support:upload', ['id'=>$fileId]));
        } else {
            $this->go(assets('user', 'img/avatar.png'));
        }
    }
}
