<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


function test(array $columns, String $table, array $where = []){
    $txt = '';
    $txt .= "SELECT ";
    $txt .= count($columns) > 0 ? implode(',', $columns) : "*";
    $txt .= " FROM {$table}";

    if (count($where) > 0) {
        $txt .= " WHERE ";
        $i = 0;
        foreach ($where as $key => $value) {
            if ($i > 0) {
                $txt .= " AND ";
            }
            $txt .= " {$key} = {$value} ";
            $i++;
        }
    }

    return $txt;
}

echo test(['email', 'password'], 'users', ['first_name' => 'ahmed', 'age' => 13]);

// $a = new User;
// $a->where('age', '<', '13')->where('first_name', 'sarah')->orWhere()->limit(100)->offset()->first();

echo "<br>";

function implodee(String $delimeter, array $data){
    $txt = '';
    foreach ($data as $key => $value) {
        $txt .= $value ;
        if ((count($data) - 1) > $key) {
            $txt .= $delimeter ;
        }
    }
    return $txt;
}

echo implodee('|', ['sarah', 'yara']);
// sarah|yara