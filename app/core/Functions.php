<?php

class Functions {

    public function developerMode($state = true)
    {
        if ($state == true) {
            ini_set("display_errors", 1);
        } else {
            ini_set("display_errors", 0);
        }
    }

}