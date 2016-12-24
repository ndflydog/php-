<?php

/**
 *用php模拟2叉树数据结构把文件中的每一行(数字)放入树中
 *二叉树的排序
 */

$origin = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

shuffle($origin);
class shu
{
    public $left = null;

    public $right = null;

    public $num;
}

$root = new shu();
#生成树
function createTree(shu $root, $origin)
{
    $left = 'left';
    $right = 'right';
    $length = count($origin);
    
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
}
#生成二叉查找树
/**
 * 什么是二叉查找树
 * 1:若它的左子树不为空，则左子树上所有节点的值均小于它的根节点的值
 * 2:若它的右子树不为空，则右子树上所有节点的值均大于它的根节点的值
 * 3:它的左、右子树也分别为二叉查找树
 */
function create2SearchTree($root, $origin)
{
    $left = 'left';
    $right = 'right';
    $length = count($origin);
    
    for ($i = 0; $i < $length; $i++) {
        $num = $origin[$i];
        if (0 == $i) {
            $root->num = $num;
            $root->left = null;
            $root->right = null;
            continue;
        }
        $tmproot = $root;
        while ($tmproot) {
            $insert = $tmproot;
            if ($tmproot->num == $num) {
                 echo '此值早已存在了';
                 break;
            }
            $tmproot = ($num < $tmproot->num) ? $tmproot->$left : $tmproot->$right;
        }
        if ($num < $insert->num) {
            $insert->$left = new shu();
            $insert->$left->num = $num;
        } else {
            $insert->$right = new shu();
            $insert->$right->num = $num;
        }
    }
}
create2SearchTree($root, $origin);
var_dump($root);