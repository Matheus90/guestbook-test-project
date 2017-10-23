<?php


class Review extends MBaseModel {

    const MAX_RATING = 5;
    const MIN_RATING = 1;

    public $name;
    public $email;
    public $review;
    public $rating;

    public $create_time;
    public $update_time;


    protected $_tableName = 'tbl_review';

    public function __construct(){
        if( !isset($this->rating) )
            $this->rating = 1;
    }

    /**
     * @return array
     */
    public function attributeLabels(){
        $pClass = get_parent_class();

        return (new $pClass())->attributeLabels() + [
            'name' => 'Name',
            'email' => 'Email Address',
            'rating' => 'Rating',
            'review' => 'Review',
            'create_time' => 'Created At',
            'update_time' => 'Updated At',
        ];
    }

    public $errors = [];

    public function validate(){
        $errors = [];

        if( $this->rating > 5 || $this->rating < 1 )
            $errors['rating'] = 'Wrong rating. It must be between 1 and 5 (inclusive).';

        if( is_null($this->email) )
            $errors['email'] = 'Email must be given.';


    }

}