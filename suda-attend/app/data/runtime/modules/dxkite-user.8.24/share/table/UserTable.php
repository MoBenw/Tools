<?php
namespace dxkite\user\table;

use suda\archive\Table;
use suda\core\Query;
use suda\core\Request;
use dxkite\user\exception\UserException;

class UserTable extends Table
{
    const STATUS_ACTIVE=1;
    const STATUS_FREEZE=0;

    public function __construct()
    {
        parent::__construct('user');
    }
    
    public function onBuildCreator($table)
    {
        return $table->fields(
            $table->field('id', 'bigint', 20)->primary()->unsigned()->auto(),
            $table->field('name', 'varchar', 255)->unique()->default(null)->comment("用户名"),
            $table->field('email', 'varchar', 255)->unique()->default(null)->comment("邮箱"),
            $table->field('password', 'varchar', 60)->default(null)->comment("密码"),
            $table->field('avatar', 'bigint', 20)->default(0)->comment("头像ID"),
            $table->field('validEmail', 'tinyint', 1)->key()->default(0)->comment("邮箱验证"),
            $table->field('signupIp', 'varchar', 32)->comment("注册IP"),
            $table->field('signupTime', 'int', 11)->comment("注册时间"),
            $table->field('status', 'tinyint', 1)->key()->default(self::STATUS_ACTIVE)->comment("用户状态")
        );
    }

    protected function _inputNameField($name)
    {
        if (!preg_match('/^[\w\x{4e00}-\x{9aff}]{4,255}$/u', $name)) {
            throw new UserException('invalid user name',UserException::NAME_FORMAT_ERROR);
        }
        return $name;
    }

    protected function _inputEmailField($email)
    {
        if (!preg_match('/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/', $email)) {
            throw new UserException('invalid user email',UserException::EMAIL_FORMAT_ERROR);
        }
        return $email;
    }

    /**
     * 通过用户名获取ID（不区分大小写）
     *
     * @param string $name
     * @return void
     */
    public function getByName(string $name)
    {
        return ($fetch=Query::where($this->getTableName(), ['id'], 'LOWER(name)=LOWER(:name)', ['name'=>$name])->fetch())?$fetch['id']:false;
    }

    /**
     * 通过关键字搜索用户
     *
     * @param string $name
     * @return void
     */
    public function searchByName(string $name)
    {
        return $this->search('name', $name)->fetchAll();
    }

    /**
     * 通过邮件搜索用户
     *
     * @param string $name
     * @return void
     */
    public function searchByEmail(string $email)
    {
        return $this->search('email', $email)->fetchAll();
    }

    /**
     * 通过用户邮箱获取ID（不区分大小写）
     *
     * @param string $email
     * @return void
     */
    public function getByEmail(string $email)
    {
        return ($fetch=Query::where($this->getTableName(), $this->getFields(), 'LOWER(email)=LOWER(:email)', ['email'=>$email])->fetch())?$fetch['id']:false;
    }

    /**
     * 设置状态
     *
     * @param int $id
     * @param int $status
     * @return void
     */
    public function setStatus(int $id, int $status)
    {
        return $this->updateByPrimaryKey($id, ['status'=>$status]);
    }

    public function getStatus(int $id)
    {
        return $this->setFields(['status'])->getByPrimaryKey($id)['status']??self::STATUS_FREEZE;
    }

    /**
     * 添加用户
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * @return void
     */
    public function add(string $name, string $email, string $password)
    {
        if (self::checkNameExists($name)) {
            throw new UserException('user name exsit',UserException::NAME_EXISTS_ERROR);
        }
        if (self::checkEmailExists($email)) {
            throw new UserException('user name exsit',UserException::EMAIL_EXISTS_ERROR);
        }
        return $this->insert([
            'name'=>$name,
            'email'=>$email,
            'password'=>password_hash($password, PASSWORD_DEFAULT),
            'signupTime'=>time(),
            'signupIp'=>Request::ip(),
            'status'=>UserTable::STATUS_ACTIVE,
        ]);
    }

    /**
     * 编辑用户信息
     *
     * @param integer $id
     * @param string $name
     * @param string $email
     * @param integer $group
     * @param string $password
     * @return void
     */
    public function edit(int $id, string $name, string $email,string $password=null)
    {
        $sets= [
            'name'=>$name,
            'email'=>$email,
            'status'=>UserTable::STATUS_ACTIVE,
        ];
        if (is_null($password)) {
            return $this->updateByPrimaryKey($id, $sets);
        }
        $sets['password']=password_hash($password, PASSWORD_DEFAULT);
        return $this->updateByPrimaryKey($id, $sets);
    }
    
    public function checkNameExists(string $name)
    {
        return $this->getByName($name);
    }

    public function checkEmailExists(string $email)
    {
        return $this->getByEmail($email);
    }

    public function changePassword(int $userid, string $password)
    {
        return $this->updateByPrimaryKey($userid, [
            'password'=>password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

    public function checkPassword(int $id, string $password)
    {
        if ($user=$this->setFields(['password'])->getByPrimaryKey($id)) {
            if (password_verify($password, $user['password'])) {
                return true;
            }
        }
        return false;
    }
}
