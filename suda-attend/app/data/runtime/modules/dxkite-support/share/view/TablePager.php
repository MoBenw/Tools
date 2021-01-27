<?php
namespace dxkite\support\view;

use suda\archive\Table;

/**
 * 表页信息构建
 */
class TablePager
{
    /**
     * 列出指定条件的内容，并进行分页
     *
     * @param Table $table 需要擦好像的表
     * @param [type] $where 查询条件
     * @param array $binder 查询条件值绑定
     * @param integer|null $page 分页
     * @param integer $row 每页书目
     * @return array
     */
    public static function listWhere(Table $table, $where, array $binder, ?int $page, int $row):array
    {
        $rows = $table->listWhere($where, $binder, $page, $row);
        $size = count($rows);

        if ($page) {
            $total = $table->count($where, $binder);
            $pervious =true;
            $maxPage = ceil($total / $row);
            if ($page >= $maxPage) {
                $next =false;
            } else {
                $next = true;
            }
            if ($page <= 1) {
                $pervious=false;
            }
            return [
                'rows'=>$rows,
                'size'=>$size,
                'total' => $total,
                'page' =>[
                    'max' => $maxPage,
                    'min' => 1 ,
                    'size'=> $row,
                    'current'=>$page,
                    'next' => $next,
                    'previous'=> $pervious,
                ]
            ];
        } else {
            return [
                'rows'=>$rows,
                'size'=> $size,
                'total' => $size,
                'page' =>[
                    'max' => 1,
                    'min' => 1 ,
                    'size'=> $size,
                    'current'=> 1,
                    'next' => false,
                    'previous'=> false,
                ]
            ];
        }
    }
    
    public static function search(Table $table, $search, string $key, $where, array $binder, ?int $page, int $row):array
    {
        $rows = $table->searchWhere($search, $key, $where, $binder, $page, $row);
        $size = count($rows);
        if ($page) {
            $total = $table->count($search, $key, $where, $binder);
            $pervious =true;
            $maxPage = ceil($total / $row);
            if ($page >= $maxPage) {
                $next =false;
            } else {
                $next = true;
            }
            if ($page <= 1) {
                $pervious=false;
            }
            return [
                'rows'=>$rows,
                'size'=>$size,
                'total' => $total,
                'page' =>[
                    'max' => $maxPage,
                    'min' => 1 ,
                    'size'=> $row,
                    'current'=>$page,
                    'next' => $next,
                    'previous'=> $pervious,
                ]
            ];
        } else {
            return [
                'rows'=>$rows,
                'size'=> $size,
                'total' => $size,
                'page' =>[
                    'max' => 1,
                    'min' => 1 ,
                    'size'=> $size,
                    'current'=> 1,
                    'next' => false,
                    'previous'=> false,
                ]
            ];
        }
    }
}
