<?php
/*
 *
 *
 */
class city_model extends model{

    function GetProvinceList()
    {
        return $this->DB_select_all('city_class', ' keyid = 0 ', 'id,name');
    }
}
?>