<?php namespace AndresRangel\Coorporation\Models;

use October\Rain\Database\Model as BaseModel;

/**
 * Role Model
 */
class Role extends BaseModel
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'andresrangel_coorporation_roles';

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [
        'employees' => [
            'AndresRangel\coorporation\Models\Employee',
            'table' => 'andresrangel_coorporation_pivots',
        ],
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];
    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    public function afterDelete()
    {
        if($this->employees()) $this->employees()->detach();
    }

    public function getEmployeesOptions()
    {
        $options = [];
        $employees = Employee::orderBy('last_name', 'asc')->orderBy('first_name', 'asc')->get();
        foreach ($employees as $employee) {
            $options[$employee->id] = $employee->name;
        }
        return $options;
    }

}