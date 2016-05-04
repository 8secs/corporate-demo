<?php namespace AndresRangel\Coorporation\Models;

use October\Rain\Database\Model as BaseModel;

/**
 * Company Model
 */
class Company extends BaseModel
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'andresrangel_coorporation_companies';

    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'andresrangel_coorporation_settings';

    public $settingsFields = 'fields.yaml';

    public $attachOne = [
        'logo' => ['System\Models\File'],
    ];

    public function getContactOptions()
    {
        return Employee::selectRaw('CONCAT(first_name, " ", last_name) as full_name, id')->orderBy('last_name')->lists('full_name', 'id');
    }

}