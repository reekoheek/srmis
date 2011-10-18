<?php

/**
 * @author Jalu Ahmad Pambudi
 * @copyright 2011
 */

class QueryProccessor
{
    var $strSQL;
    var $modeSelect;
    var $tableName;
    
    public function __construct($strsql, $table) {
        $this->strSQL = $strsql;
        $this->tableName = $table;        
    }

    function table(){
        if (!$table){
            $table='master_barang';
            return $this->tableName = $table;
        }
        else{
            return $this->tableName = $table;
        }        
    }
    public function __destruct() {
        $this->strSQL = nothing;
        $this->tableName = nothing;
    }

    
    public function queryType() {
        
    } 
    public function queryGo($strSQL){
        $results = array();
        if (!$strSQL){
            
        }
        else{
            
        }
    }
    public function requeryMe()
    {
        
    }
    public function getTableName()
    {
        
    }
    public function getIndex()
    {
        
    }
}
?>