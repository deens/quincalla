<?php
namespace Quincalla\Entities;

trait SmartRulesTrait
{
    protected $rulesRelations = [
        'is_equal_to'       => 'is equal to',
        'is_not_equal_to'   => 'is not equal to',
        'is_greater_than'   => 'is greater than',
        'is_less_than'      => 'is less than',
        'start_with'        => 'start with',
        'ends_with'         => 'ends with',
        'contains'          => 'contains',
        'does_not_contain'  => 'does not contain',
    ];

    /**
     * Returns an array with rules columns
     *
     * @return array
     */
    public function getRulesColumns()
    {
        return $this->rulesColumns;
    }

    /**
     * Returns a array with rules relations
     *
     * @return array
     */
    public function getRulesRelations()
    {
        return $this->rulesRelations;
    }

    /**
     * Returns a sorted collection of items base on match type and rules.
     * 
     * @param string $match
     * @param array $rules
     * @param string $sort_order
     * @return Collection
     */
    public static function getByRules($match, $rules = [])
    {
        $rules = json_decode($rules);
        $query = self::where('published', true);

        foreach ($rules as $key => $rule) {
            $method = camel_case($match .'_'. $rule[1]->relation);
            if (method_exists(get_called_class(), $method)) {
                call_user_func_array(array(get_called_class(), $method), [
                    $query,
                    $rule[0]->column,
                    $rule[2]->condition
                ]);
            }
        }

        return $query->get();
    }

    public static function allIsEqualTo($query, $field, $condition)
    {
        return $query->where($field, $condition);
    }

    public static function allIsNotEqualTo($query, $field, $condition)
    {
        return $query->where($field, '<>', $condition);
    }

    public static function allIsGreaterThan($query, $field, $condition)
    {
        return $query->where($field, '<', $condition);
    }

    public static function allLessThan($query, $field, $condition)
    {
        return $query->where($field, '>', $condition);
    }

    public static function allStartWith($query, $field, $condition)
    {
        return $query->where($field, 'LIKE', $condition.'%');
    }

    public static function allEndsWith($query, $field, $condition)
    {
        return $query->where($field, 'LIKE', '%'.$condition);
    }

    public static function allContains($query, $field, $condition)
    {
        return $query->where($field, 'LIKE', '%'.$condition.'%');
    }

    public static function allDoesNotContains($query, $field, $condition)
    {
        return $query->where($field, 'NOT LIKE', '%'.$condition.'%');
    }

    public static function anyIsEqualTo($query, $field, $condition)
    {
        return $query->orWhere($field, $condition);
    }

    public static function anyIsNotEqualTo($query, $field, $condition)
    {
        return $query->orWhere($field, '<>', $condition);
    }

    public static function anyIsGreaterThan($query, $field, $condition)
    {
        return $query->orWhere($field, '<', $condition);
    }

    public static function anyLessThan($query, $field, $condition)
    {
        return $query->orWhere($field, '>', $condition);
    }

    public static function anyStartWith($query, $field, $condition)
    {
        return $query->orWhere($field, 'LIKE', $condition.'%');
    }

    public static function anyEndsWith($query, $field, $condition)
    {
        return $query->orWhere($field, 'LIKE', '%'.$condition);
    }

    public static function anyContains($query, $field, $condition)
    {
        return $query->orWhere($field, 'LIKE', '%'.$condition.'%');
    }

    public static function anyDoesNotContains($query, $field, $condition)
    {
        return $query->orWhere($field, 'NOT LIKE', '%'.$condition.'%');
    }
}
