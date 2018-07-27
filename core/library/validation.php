<?php

function required($data)
{
    if (empty($data)) {
        return false;
    }
    return true;
}

function length($data, $min, $max)
{
    if (strlen($data) < $min || strlen($data) > $max) {
        return false;
    }
    return false;
}

function login($data)
{
    if (!preg_match('/[a-zA-Zа-яА-ЯёЁ0-9 _]/', $data)) {
        if (strlen($data) < 5 || strlen($data) > 60) {
            return false;
        }
        return false;
    }
    return true;
}

function email($data)
{
    if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}

function password($data)
{
    if (preg_match('/[^0-9a-zA-Z]/', $data)) {
        if (strlen($data) < 5 || strlen($data) > 30) {
            return false;
        }
        return false;
    }
    return true;
}

function password2($data)
{
    if (preg_match('/[^0-9a-zA-Z]/', $data)) {
        if (strlen($data) < 5 || strlen($data) > 30) {
            return false;
        }
        return false;
    }
    return true;
}

//function length($data){
//    if (strlen($data) < 5 || strlen($data) > 30){
//        return false;
//    }
//    return true;
//}
function validateForm($dataWithRules, $data)
{
    $fields = array_keys($dataWithRules);
    $errorForms = [];

    if (isset($dataWithRules['password2'])) {
        $password = $data['password'];
        $password2 = $data['password2'];

        if ($password != $password2) {
            $errorForms['password2'][] = 'equal';
        }
    }

    foreach ($fields as $fieldName) {
        $fieldData = $data[$fieldName];
        $rules = $dataWithRules[$fieldName];

        foreach ($rules as $ruleName) {
            if (!$ruleName($fieldData)) {
                $errorForms[$fieldName][] = $ruleName;
            }
        }
    }

    return $errorForms;
}
