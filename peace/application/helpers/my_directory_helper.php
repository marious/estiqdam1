<?php

function mkdir_if_not_exist($path, $mode = 0777, $recursive = true)
{
    if (!is_dir($path))
    {
        $oldmask = umask(0);
        mkdir($path, $mode, $recursive);
        umask($oldmask);

    }
}