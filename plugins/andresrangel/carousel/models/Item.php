<?php namespace AndresRangel\Carousel\Models;

use Model;
use Carbon\Carbon;

/**
 * Item Model
 */
class Item extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'andresrangel_carousel_items';

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
    public $hasMany = [];
    public $belongsTo = [
        'slide' => 'AndresRangel\Carousel\Models\Slide',
        'item_type'  => 'AndresRangel\Carousel\Models\ItemType',
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
        $postItem = post('Item');
        if(strlen($postItem['published_at']) == 0) $this->published_at = Carbon::now();
    }

    public function afterDelete()
    {
        if($this->image){
            $this->image->delete();
        }
    }

    public function getAnimationOptions()
    {
        return [
            'sft'           => 'Short From Top',
            'sfb'           => 'Short From Bottom',
            'sfr'           => 'Short From Right',
            'sfl'           => 'Short From Left',
            'lft'           => 'Long From Top',
            'lfb'           => 'Long From Bottom',
            'lfr'           => 'Long From Right',
            'lfl'           => 'Long From Left',
            'fade'          => 'Fade',
        ];
    }

    public function getTargetOptions(){
        return [
            '_blank'        => 'Blank',
            '_parent'       => 'Parent',
            '_self'         => 'Self',
            '_top'          => 'Top',
            'page-scroll'   => 'Anchor in same page',
        ];
    }

    public function getEasingOptions()
    {
        return $this->getEasings();
    }

    public function getEndEasingOptions()
    {
        return $this->getEasings();
    }


    protected function getEasings(){
        return [
            'Linear.easeNone'               => 'Linear.easeNone',
            'Power0.easeIn'                 => 'Power0.easeIn',
            'Power0.easeInOut'              => 'Power0.easeInOut',
            'Power0.easeOut'                => 'Power0.easeOut',
            'Power1.easeIn'                 => 'Power1.easeIn',
            'Power1.easeInOut'              => 'Power1.easeInOut',
            'Power1.easeOut'                => 'Power1.easeOut',
            'Power2.easeIn'                 => 'Power2.easeIn',
            'Power2.easeInOut'              => 'Power2.easeInOut',
            'Power2.easeOut'                => 'Power2.easeOut',
            'Power3.easeIn'                 => 'Power3.easeIn',
            'Power3.easeInOut'              => 'Power3.easeInOut',
            'Power3.easeOut'                => 'Power3.easeOut',
            'Power4.easeIn'                 => 'Power4.easeIn',
            'Power4.easeInOut'              => 'Power4.easeInOut',
            'Power4.easeOut'                => 'Power4.easeOut',
            'Back.easeIn'                   => 'Back.easeIn',
            'Back.easeInOut'                => 'Back.easeInOut',
            'Back.easeOut'                  => 'Back.easeOut',
            'Bounce.easeIn'                 => 'Bounce.easeIn',
            'Bounce.easeInOut'              => 'Bounce.easeInOut',
            'Bounce.easeOut'                => 'Bounce.easeOut',
            'Circ.easeIn'                   => 'Circ.easeIn',
            'Circ.easeInOut'                => 'Circ.easeInOut',
            'Circ.easeOut'                  => 'Circ.easeOut',
            'Elastic.easeIn'                => 'Elastic.easeIn',
            'Elastic.easeInOut'             => 'Elastic.easeInOut',
            'Elastic.easeOut'               => 'Elastic.easeOut',
            'Expo.easeIn'                   => 'Expo.easeIn',
            'Expo.easeInOut'                => 'Expo.easeInOut',
            'Expo.easeOut'                  => 'Expo.easeOut',
            'Sine.easeIn'                   => 'Sine.easeIn',
            'Sine.easeInOut'                => 'Sine.easeInOut',
            'Sine.easeOut'                  => 'Sine.easeOut',
            'SlowMo.ease'                   => 'SlowMo.ease',
        ];
    }

    public function getTextFormatOptions()
    {
        return [
            'small_text'                => 'Small Text',
            'medium_text'               => 'Medium Text',
            'large_text'                => 'Large Text',
            'very_large_text'           => 'Very Large Text',
            'very_big_white'            => 'Very Big White',
            'very_big_black'            => 'Very Big Black',
            /*'modern_medium_fat'         => 'Modern Medium Fat',
            'modern_medium_fat_white'   => 'Modern Medium Fat White',
            'modern_medium_light'       => 'Modern Medium Light',
            'modern_big_bluebg'         => 'Modern Big Blue Background',
            'modern_big_redbg'          => 'Modern Big Red Background',
            'modern_small_text_dark'    => 'Modern Small Text Dark',
            'thinheadline_dark'         => 'Thin Headline Dark',
            'thintext_dark'             => 'Thin Text Dark',
            'largeblackbg'              => 'Large Black Background',
            'largepinkbg'               => 'Large Pink Background',
            'largewhitebg'              => 'Large White Background',
            'largegreenbg'              => 'Large Green Background',
            'excerpt'                   => 'Excerpt',
            'medium_grey'               => 'Medium Grey',
            'large_bold_grey'           => 'Large Bold Grey',
            'medium_thin_grey'          => 'Medium Thin Grey',
            'small_thin_grey'           => 'Small Thin Gray',
            'lightgrey_divider'         => 'Light Grey Divider',
            'large_bold_darkblue'       => 'Large Bold Dark Blue',
            'medium_bg_darkblue'        => 'Medium Dark Blue Background',
            'medium_bold_red'           => 'Medium Bold Red',
            'medium_light_red'          => 'Medium Light Red',
            'medium_bg_red'             => 'Medium Red Background',
            'medium_bold_orange'        => 'Medium Bold Orange',
            'medium_bg_orange'          => 'Medium Orange Background',
            'large_bold_white'          => 'Large Bold White',
            'medium_light_white'        => 'Medium Light White',
            'mediumlarge_light_white'   => 'Medium-Large Light White',
            'mediumlarge_light_white_center' => 'Medium-Large Light White Center',
            'medium_bg_asbestos'        => 'Medium Asbestos Background',
            'medium_light_black'        => 'Medium Light Black',
            'mediumlarge_light_darkblue'=> 'Medium-Large Light Dark Blue',
            'small_light_white'         => 'Small Light White',
            'large_bg_black'            => 'Large Black Background',
            'mediumwhitebg'             => 'Medium White Background'*/
        ];
    }

    public function filterFields($fields, $context = null)
    {

        if(isset($this->item_type->id)){

            switch ($this->item_type->id) {
                case 1:
                    $fields->image->hidden = true;
                    $fields->content->hidden = false;
                    $fields->text_format->hidden = false;
                    $fields->width->hidden = true;
                    $fields->height->hidden = true;
                    $fields->color->hidden = true;
                    $fields->alpha->hidden = true;
                    $fields->url->hidden = true;
                    $fields->target->hidden = true;
                    break;
                case 2:
                    $fields->image->hidden = true;
                    $fields->content->hidden = true;
                    $fields->text_format->hidden = true;
                    $fields->width->hidden = false;
                    $fields->height->hidden = false;
                    $fields->color->hidden = false;
                    $fields->alpha->hidden = false;
                    $fields->url->hidden = true;
                    $fields->target->hidden = true;
                    break;
                case 3:
                    $fields->image->hidden = true;
                    $fields->content->hidden = false;
                    $fields->text_format->hidden = false;
                    $fields->width->hidden = false;
                    $fields->height->hidden = false;
                    $fields->color->hidden = true;
                    $fields->alpha->hidden = true;
                    $fields->url->hidden = false;
                    $fields->target->hidden = false;
                    break;
                case 4:
                    $fields->image->hidden = false;
                    $fields->content->hidden = true;
                    $fields->text_format->hidden = true;
                    $fields->width->hidden = false;
                    $fields->height->hidden = false;
                    $fields->color->hidden = true;
                    $fields->alpha->hidden = true;
                    $fields->url->hidden = true;
                    $fields->target->hidden = true;
                    break;
            }
        }else{
            $fields->image->hidden = true;
            $fields->content->hidden = false;
            $fields->text_format->hidden = false;
            $fields->width->hidden = true;
            $fields->height->hidden = true;
            $fields->color->hidden = true;
            $fields->alpha->hidden = true;
            $fields->url->hidden = true;
            $fields->target->hidden = true;
        }

    }

}