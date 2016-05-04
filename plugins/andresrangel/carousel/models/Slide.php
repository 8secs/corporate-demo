<?php namespace AndresRangel\Carousel\Models;

use Model;
use Carbon\Carbon;

/**
 * Slide Model
 */
class Slide extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'andresrangel_carousel_slides';

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
    public $hasOne = [

    ];
    public $hasMany = [
        'items' => 'AndresRangel\Carousel\Models\Item',
    ];
    public $belongsTo = [
        'carousel' => 'AndresRangel\Carousel\Models\Carousel',
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'image' => 'System\Models\File'
    ];
    public $attachMany = [];

    public function beforeSave()
    {
        $postSlide = post('Slide');
        if(strlen($postSlide['published_at']) == 0) $this->published_at = Carbon::now();
    }

    public function afterDelete()
    {
        if($this->image){
            $$this->image->delete();
        }
    }

    public function getTransitionOptions(){
        return [
            '' => 'Select transition',
            'boxslide'                      => 'Box Slide',
            'boxfade'                       => 'Box Fade',
            'slotzoom-horizontal'           => 'Slot Zoom Horizontal',
            'slotslide-horizontal'          => 'Slot Slide Horizontal',
            'slotfade-horizontal'           => 'Slot Fade Horizontal',
            'slotzoom-vertical'             => 'Slot Zoom Vertical',
            'slotslide-vertical'            => 'Slot Slide Vertical',
            'slotfade-vertical'             => 'Slot Fade Vertical',
            'curtain-1'                     => 'Courtain One',
            'curtain-2'                     => 'Courtain Two',
            'curtain-3'                     => 'Courtain Three',
            'slideleft'                     => 'Slide Left',
            'slideright'                    => 'Slide Right',
            'slideup'                       => 'Slide Up',
            'slidedown'                     => 'Slide Down',
            'fade'                          => 'Fade',
            'papercut'                      => 'Paper Cut',
            '3dcurtain-horizontal'          => '3D Curtain Horizontal',
            '3dcurtain-vertical'            => '3D Curtain Vertical',
            'cubic'                         => 'Cubic',
            'cube'                          => 'Cube',
            'flyin'                         => 'Flyin',
            'turnoff'                       => 'Turn off',
            'incube'                        => 'In cube',
            'cubic-horizontal'              => 'Cubic Horizontal',
            'cube-horizontal'               => 'Cube Horizontal',
            'incube-horizontal'             => 'Incube Horizontal',
            'turnoff-vertical'              => 'Turn off Vertical',
            'fadefromright'                 => 'Fade From Right',
            'fadefromleft'                  => 'Fade From Left',
            'fadefromtop'                   => 'Fade From Top',
            'fadefrombottom'                => 'Fade From Bottom',
            'fadetoleftfadefromright'       => 'Fade To Left / Fade From Right',
            'fadetorightfadetoleft'         => 'Fade To Right / Fade To Left',
            'fadetobottomfadefromtop'       => 'Fade To Bottom / Fade From Top',
            'fadetotopfadefrombottom'       => 'Fade To Top / Fade From Bottom',
            'parallaxtoright'               => 'Parallax To Right',
            'parallaxtoleft'                => 'Parallax To Left',
            'parallaxtobottom'              => 'Parallax To Bottom',
            'scaledownfromright'            => 'Scale Down From Right',
            'scaledownfromleft'             => 'Scale Down To Left',
            'scaledownfromtop'              => 'Scale Down From Top',
            'scaledownfrombottom'           => 'Scale Down From Bottom',
            'zoomout'                       => 'Zoom Out',
            'zoomin'                        => 'Zoom In',
            'notransition'                  => 'No transition',
        ];
    }

    public function getItemsOptions(){
        return Item::where('slide_id', $this->id)->get();
    }
}