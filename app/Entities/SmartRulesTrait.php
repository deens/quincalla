<?php

namespace Quincalla\Entities;

use Illuminate\Database\Eloquent\Builder;

trait SmartRulesTrait
{
    protected $rulesRelations = [
        'is_equal_to'      => 'is equal to',
        'is_not_equal_to'  => 'is not equal to',
        'is_greater_than'  => 'is greater than',
        'is_less_than'     => 'is less than',
        'start_with'       => 'start with',
        'ends_with'        => 'ends with',
        'contains'         => 'contains',
        'does_not_contain' => 'does not contain',
    ];

    protected $rulesSortDefaults = [
        'manually'   => 'Manually',
        'best-match' => 'Best Match',
    ];

    /**
     * Returns an array with rules columns.
     *
     * @return array
     */
    public function getRulesColumns()
    {
        return $this->rulesColumns;
    }

    /**
     * Returns a array with rules relations.
     *
     * @return array
     */
    public function getRulesRelations()
    {
        return $this->rulesRelations;
    }

    /**
     * Returns an array with sort option.
     *
     * @return array
     */
    public function getRulesSortOptions()
    {
        $sortOptions = [];
        if (count($this->rulesSortOptions)) {
            foreach ($this->rulesSortOptions as $field => $direction) {
                $keys = array_keys($direction);
                $sortOptions[$field.'-'.$keys[0]] = $direction[$keys[0]];
                $sortOptions[$field.'-'.$keys[1]] = $direction[$keys[1]];
            }
        }

        return array_merge($this->rulesSortDefaults, $sortOptions);
    }

    /**
     * Returns a sorted collection of items base on match type and rules.
     *
     * @param string $match     Type of match all or any
     * @param array  $rules     List of rules to apply
     * @param string $sortOrder Sort by field and direction
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getByRules($match, $rules = [], $sortOrder = 'manually')
    {
        $query = self::where('published', true);

        self::applyRules($query, $match, $rules);

        if ($sortOrder !== 'manually' && $sortOrder !== 'best-match') {
            $sort = explode('-', $sortOrder);
            self::sortOrderByField($query, $sort[0], $sort[1]);
        }

        return $query->get();
    }

    /**
     * Returns a paginated collection of items base on match type and rules.
     *
     * @param string $match     Type of match all or any
     * @param array  $rules     List of rules to apply
     * @param string $sortOrder Sort by field and direction
     * @param int    $limit     Limit of items to paginate
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function paginateByRules($match, $rules = [], $sortOrder = 'manually', $limit = 6)
    {
        $query = self::where('published', true);

        self::applyRules($query, $match, $rules);

        if ($sortOrder !== 'manually' && $sortOrder !== 'best-match') {
            $sort = explode('-', $sortOrder);
            self::sortOrderByField($query, $sort[0], $sort[1]);
        }

        return $query->paginate($limit);
    }

    /**
     * Apply rules.
     *
     * @param Builder $query
     * @param string  $match
     * @param array   $rules Array of rules.
     */
    public static function applyRules(Builder $query, $match, $rules)
    {
        foreach ($rules as $key => $rule) {
            $method = camel_case($match.'_'.$rule[1]->relation);

            if (method_exists(get_called_class(), $method)) {
                call_user_func_array([get_called_class(), $method], [
                    $query,
                    $rule[0]->column,
                    $rule[2]->condition,
                ]);
            }
        }
    }

    /**
     * Sort items base on sort order.
     *
     * @param Builder $query
     * @param string $sortOrder
     */
    public static function sortOrderRule(Builder $query, $sortOrder)
    {
        if ($sortOrder !== 'manually' && $sortOrder !== 'best-match') {
            $sort = explode('-', $sortOrder);
            self::sortOrderByField($query, $sort[0], $sort[1]);
        }
    }

    public static function allIsEqualTo(Builder $query, $field, $condition)
    {
        return $query->where($field, $condition);
    }

    public static function allIsNotEqualTo(Builder $query, $field, $condition)
    {
        return $query->where($field, '<>', $condition);
    }

    public static function allIsGreaterThan(Builder $query, $field, $condition)
    {
        return $query->where($field, '<', $condition);
    }

    public static function allLessThan(Builder $query, $field, $condition)
    {
        return $query->where($field, '>', $condition);
    }

    public static function allStartWith(Builder $query, $field, $condition)
    {
        return $query->where($field, 'LIKE', $condition.'%');
    }

    public static function allEndsWith(Builder $query, $field, $condition)
    {
        return $query->where($field, 'LIKE', '%'.$condition);
    }

    public static function allContains(Builder $query, $field, $condition)
    {
        return $query->where($field, 'LIKE', '%'.$condition.'%');
    }

    public static function allDoesNotContains(Builder $query, $field, $condition)
    {
        return $query->where($field, 'NOT LIKE', '%'.$condition.'%');
    }

    public static function anyIsEqualTo(Builder $query, $field, $condition)
    {
        return $query->orWhere($field, $condition);
    }

    public static function anyIsNotEqualTo(Builder $query, $field, $condition)
    {
        return $query->orWhere($field, '<>', $condition);
    }

    public static function anyIsGreaterThan(Builder $query, $field, $condition)
    {
        return $query->orWhere($field, '<', $condition);
    }

    public static function anyLessThan(Builder $query, $field, $condition)
    {
        return $query->orWhere($field, '>', $condition);
    }

    public static function anyStartWith(Builder $query, $field, $condition)
    {
        return $query->orWhere($field, 'LIKE', $condition.'%');
    }

    public static function anyEndsWith(Builder $query, $field, $condition)
    {
        return $query->orWhere($field, 'LIKE', '%'.$condition);
    }

    public static function anyContains(Builder $query, $field, $condition)
    {
        return $query->orWhere($field, 'LIKE', '%'.$condition.'%');
    }

    public static function anyDoesNotContains(Builder $query, $field, $condition)
    {
        return $query->orWhere($field, 'NOT LIKE', '%'.$condition.'%');
    }

    public static function sortOrderByField(Builder $query, $field, $sortOrder = 'asc')
    {
        return $query->orderBy($field, $sortOrder);
    }
}
