<?php namespace AndresRangel\Carousel\Models;

use Model;

/**
 * ItemType Model
 */
class ItemType extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'andresrangel_carousel_item_types';

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
        'items' => 'AndresRangel\Carousel\Models\Item',
    ];
    public $belongsTo = [

    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function getItemsOptions(){
        return Item::where('item_type_id', $this->id)->get();
    }
}