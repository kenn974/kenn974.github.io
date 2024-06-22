<?php

//引数に文字列を取って、文字列を返すイメージした関数
function escape($string)
{
    /*指定されたある文字列を取ってhtmlspecialcharsで変換したエスケープした文字列を返す*/
    //変換したい文字列を受け取りたいので引数にSTRING
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
