<?php

function redirect($url){
    header('location: ' . URL_ROOT . '/' . $url);
}
