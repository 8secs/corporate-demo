<?php namespace AndresRangel\Coorporation\Models;


/**
 * Gallery Model
 */
class Gallery extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'andresrangel_coorporation_galleries';

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [
        'pictures' => ['System\Models\File'],
    ];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    public function afterDelete()
    {
        if($this->pictures && $this->pictures->count() > 0){
            foreach ($this->pictures as $item) {
                $item->delete();
            }
        }
    }
}