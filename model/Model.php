<?php

class Model {


    protected function setInsertParam($fields)
    {
        $ret            = [];
        $list_fields    = [];
        $list_params    = [];

        foreach ($fields as $val) {
            $list_fields[]  = $val;
            $list_params[]  = ":".$val;
        }

        $ret['fields']  = implode(",", $list_fields);
        $ret['params']  = implode(",", $list_params);

        return $ret;
    }

    protected function setUpdateParam($fields)
    {
        $ret            = [];
        $list_fieldset  = [];

        foreach ($fields as $key => $val) {
            $list_fieldset[]    = $key . "=:". $key;
        }

        $ret['fields']  = implode(",", $list_fieldset);

        return $ret;
    }

    public function setSearch($fields, $search, $default)
    {
        $ret    = [];

        if ($search !== "") {
            $search_text    = trim($search, " ");
            $search_text    = str_replace(" ", "%", $search_text);
            $list_clause    = [];
            $list_params    = [];

            foreach ($fields as $val) {
                $list_clause[]  = $val . " LIKE ? ";
                $list_params[]  = "%".$search_text."%";
            }

            $ret['clause']  = implode(" OR ", $list_clause);
            $ret['params']  = $list_params;
        } else {
            $ret['clause']  = $default;
            $ret['params']  = [];
        }

        return $ret;
    }

}