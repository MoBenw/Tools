<?php
namespace dxkite\user\table;

use suda\archive\Table;

/**
 * 邀请注册码系统
 */
class InviteTable extends Table
{
    const STATUS_ACTIVE=1;
    const STATUS_FREEZE=0;

    public function __construct()
    {
        parent::__construct('user_invite');
    }
    
    public function onBuildCreator($table)
    {
        return $table->fields(
            $table->field('id', 'bigint', 20)->primary()->unsigned()->auto(),
            $table->field('user', 'bigint', 20)->unsigned()->comment('用户ID'),
            $table->field('invitedCode', 'varchar', 32)->default(null)->comment('注册的邀请码'),
            $table->field('inviteCode', 'varchar', 32)->key()->unique()->default(null)->comment("邀请码"),
            $table->field('time', 'int', 11)->key()->unsigned()->comment('过期时间')
        );
    }
}
