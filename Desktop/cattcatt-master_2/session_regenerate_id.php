<?php
session_start();

$old_session_id = session_id();

session_regenerate_id(true);

$new_session_id = session_id();

echo " <P>{$old_session_id}</P>";
echo " <P>{$new_session_id}</P>";
