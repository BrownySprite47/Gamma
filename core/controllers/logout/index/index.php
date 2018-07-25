<?php

function index() {
    session_unset();
    session_destroy();
    header("location: /");
}
