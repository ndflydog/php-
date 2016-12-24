<?php

/**
 *用php模拟2叉树数据结构把文件中的每一行(数字)放入树中
 *二叉树的排序
 */

$origin = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

class shu
{
    public $left = null;

    public $right = null;

    public $num;
}

$root = new shu();
$length = count($origin);
$left = 'left';
$right = 'right';
for ($i = 0; $i < $length; $i++) {
    if (0 == $i) {
        $root->num = $origin[$i];
        $root->left = null;
        $root->right = null;
        continue;
    }
    $bool = true;    
    $tmpright = $tmpleft = $tmproot = $root;
    while (1) {
        if (!$tmproot->$left) {
            $tmproot->$left = new shu();
            $tmproot->$left->num = $origin[$i];
            break;
        } elseif (!$tmproot->$right) {
            $tmproot->$right = new shu();
            $tmproot->$right->num = $origin[$i];
            break;
        } else {
            if ($bool) {
                $tmproot = $tmpleft->$left;
                $tmpleft = $tmpleft->$left;
                $bool = false;
            } else {
                $tmproot = $tmpright->$right;
                $tmpright = $tmpright->$right;
                $bool = true;          
            }
        }
    }
}
var_dump($root);