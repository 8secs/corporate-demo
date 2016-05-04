<?php namespace AndresRangel\Coorporation\Models;

/**
 * Testimonial Model
 */
class Testimonial extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'andresrangel_coorporation_testimonials';

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
    public $attachOne = [
        'picture' => ['System\Models\File'],
    ];
    public $attachMany = [];
    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    public function afterDelete()
    {
        if($this->picture) $this->picture->delete();
    }

}