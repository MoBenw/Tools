<?php

namespace suda\lostandfound\manager;

class UserManager
{
    public static function install()
    {
        $table1 = new \suda\lostandfound\table\UserTable;
        $table1-> insert([
            'tel' => '15273442041',
            'passwd' => 'admin',
            'role' => 1,
        ]);
        $table2 = new \suda\lostandfound\table\ObjectTable;
        $table2-> insert([
            'name' => '',
            
        ]);
    }
}
