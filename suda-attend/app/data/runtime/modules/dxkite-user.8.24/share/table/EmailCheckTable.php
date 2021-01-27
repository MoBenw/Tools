<?php
namespace dxkite\user\table;

use suda\archive\Table;

class EmailCheckTable extends Table
{
    public function __construct()
    {
        parent::__construct('user_email_check');
    }
    
    public function onBuildCreator($table)
    {
        return $table->fields(
            $table->field('id', 'bigint', 20)->primary()->unsigned()->auto(),
            $table->field('user', 'bigint', 20)->unsigned()->comment('用户ID'),
            $table->field('email', 'varchar', 255)->default(null)->comment('邮件'),
            $table->field('token', 'varchar', 32)->key()->comment("验证码"),
            $table->field('time', 'int', 11)->key()->unsigned()->comment('过期时间')
        );
    }
}
