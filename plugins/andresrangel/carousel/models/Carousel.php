<?php namespace AndresRangel\Carousel\Models;

use Model;
use Carbon\Carbon;

/**
 * Carousel Model
 */
class Carousel extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'andresrangel_carousel_carousels';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'slides' => 'AndresRangel\Carousel\Models\Slide',
    ];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [

    ];
    public $attachMany = [];

    public function beforeSave()
    {
        $postCarousel = post('Carousel');
        if(strlen($postCarousel['published_at']) == 0) $this->published_at = Carbon::now();
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<', date('Y-m-d H:i:s'));
    }

    public function getSlidesOptions(){
        return Item::where('carousel_id', $this->id)->get();
    }

}