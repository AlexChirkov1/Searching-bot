<?php
// function OpenCon()
// {
//     $link = mysqli_connect("localhost", "root", "password", "searchbot");

//     if (!$link) {
//         echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
//         echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
//         echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
//         exit;
//     }

//     return $link;
// }

// function CloseCon($link)
// {
//     $link->close();
// }

//end local bd

function OpenCon()
{
    $link = mysqli_connect("search.ctvrbtytqojv.us-east-2.rds.amazonaws.com", "root", "xc3pdvpdv", "searchbot");

    if (!$link) {
        echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
        echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    return $link;
}

function CloseCon($link)
{
    $link->close();
}