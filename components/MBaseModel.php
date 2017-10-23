<?php

class MBaseModel {

    // Model ID
    public $id = null;

    // Name of the table the model is made from
    protected $_tableName = null;

    public function tableName(){
        return $this->_tableName;
    }

    function __construct() {

    }

    public function attributeLabels(){
        return [
            'id' => 'ID'
        ];
    }


    public function setAttributes($dataArray = []){
        $attributes = array_keys($this->attributeLabels());

        foreach($attributes as $attr){
            if( isset($dataArray[$attr]) && property_exists(get_class($this), $attr) ){
                $this->$attr = $dataArray[$attr];
            }
        }
    }

    /**
     * Array of the model's attributes (with values)
     *
     * @return array
     */
    public function getAttributes(){
        $attributes = array_keys($this->attributeLabels());

        $dataArray = [];
        foreach($attributes as $attr){
            if( !isset($dataArray[$attr]) && property_exists(get_class($this), $attr) ){
                $dataArray[$attr] = $this->$attr;
            }
        }

        return $dataArray;
    }

    /**
     * Returns an empty instance of the current class it's called from
     *
     * @return mixed
     */
    public static function model(){
        $thisClass = get_called_class();

        return new $thisClass();
    }

    /**
     * Check is tableName is given, die out with error if not.
     */
    protected function checkTable(){
        if( is_null($this->_tableName) )
            exit('Error: Database table "'.($this->_tableName).'" does not exist.');
    }

    /**
     * Is this model stored in DB?
     *
     * @return bool
     */
    public function isNewModel(){
        if( !is_null($this->id) ){
            $sql = "SELECT * FROM `".$this->_tableName."` WHERE `id` = '".($this->id | -1)."'";

            $model = App::db()->query($sql);
            return !$model;
        } else
            return true;
    }


    /**
     * Save function to handle insert and update scenarios
     *
     * @return bool
     */
    public function save(){
        $this->checkTable();

        $attributes = $this->getAttributes();
        if( $this->isNewModel() ){
            $sql = "INSERT INTO `".$this->_tableName."` ";

            unset($attributes['id']);
            if( in_array('create_time', array_keys($attributes)) )
                $attributes['create_time'] = (new DateTime())->format('Y-m-d h:i:s');

            extract($this->getInsertAttrList($attributes));

            $sql .= "($sqlColumns) VALUES ($sqlValues)";

            $stmt = App::db()->prepare($sql);
            if( $stmt->execute($attributes) ){
                $this->id = App::db()->lastInsertId();
                return true;
            } else {
                return false;
            }

        } else {
            $sql = "UPDATE `".$this->_tableName."` ";

            unset($attributes['id']);
            if( in_array('update_time', array_keys($attributes))  )
                $attributes['update_time'] = (new DateTime())->format('Y-m-d h:i:s');

            $setPairs = $this->getUpdateAttrList($attributes);

            $sql .= "SET ".$setPairs." WHERE `id`='".$this->id."'";

            $stmt = App::db()->prepare($sql);
            if( $stmt->execute($attributes) )
                return true;
            else
                return false;
        }

    }

    /**
     *  Delete placeholder does not needed yet
     */
    public function delete(){

    }


    /**
     * Get the column name and values list for the insert sql:
     * $sqlColumns  = "`name`, `email`";
     * $sqlValues   = "'John Doe','fake@email.com'";
     *
     * @param null $attributes
     * @return array
     */
    public function getInsertAttrList($attributes = null){
        $attributes = $attributes ?: $this->getAttributes();

        $sqlColumns = '';
        $sqlValues = '';
        $colCount = 0;

        foreach($attributes as $attr => $value){

            $glue = (!!$colCount ? "," : "");
            $sqlColumns .= $glue . "`$attr`";
            $sqlValues  .= $glue . ":$attr";

            ++$colCount;
        }

        return compact('sqlColumns', 'sqlValues');
    }


    /**
     * Get the column=value pair list for the Update sql:
     * setPairs = "`name`='Jonathan Doe',`email`='morefake@email.com'";
     *
     * @param null $attributes
     * @return string
     */
    public function getUpdateAttrList($attributes = null){
        $attributes = $attributes ?: $this->getAttributes();

        $setPairs = '';
        $colCount = 0;

        foreach($attributes as $attr => $value){
            $glue = (!!$colCount ? "," : "");

            $setPairs .= $glue . "`$attr`=:$attr";

            ++$colCount;
        }

        return $setPairs;
    }
}