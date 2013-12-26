<?php

class yapf_Template_Function
{


    public function getCurrentTimestamp()
    {
        return time();
    }

    public static function _n_rus()
    {
        if (func_num_args() != 4) {
            return;
        }

        $args = func_get_args();
        $count_1 = array_shift($args);
        $count_2to4 = array_shift($args);
        $count_5to0 = array_shift($args);
        $n = array_shift($args);
        $m = $n % 100;
        if ($m < 20) {
            if ($m == 1) {
                $returnString = sprintf($count_1, $n);
            } elseif ($m > 1 && $m < 5) {
                $returnString = sprintf($count_2to4, $n);
            } elseif ($m > 4 || $m == 0) {
                $returnString = sprintf($count_5to0, $n);
            }
        } else {
            $divisionTail = $m % 10;
            if ($divisionTail == 1) {
                $returnString = sprintf($count_1, $n);
            } elseif ($divisionTail > 1 && $divisionTail < 5) {
                $returnString = sprintf($count_2to4, $n);
            } elseif ($divisionTail > 4 || $divisionTail == 0) {
                $returnString = sprintf($count_5to0, $n);
            }
        }
        return $returnString;
    }

    public static function _($var)
    {
        return yapf_Locale::getInstance()->getVar($var);
    }

    public function nav($nav, $arr)
    {
        return Navigation::getInstance()->getUrl($nav, $arr);
    }

}