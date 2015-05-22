<?php namespace Quincalla;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Laracasts\Presenter\PresentableTrait;

class Product extends Model {

    use SearchableTrait;
    use PresentableTrait;

    protected $table = 'products';
    protected $fillable = [];
    protected $searchable = [
        'columns' => [
            'name' => 10,
            'description' => 5,
        ]
    ];

    protected $presenter = 'Quincalla\Http\Presenters\ProductPresenter';

    public function collection()
    {
        return $this->belongsTo('Quincalla\Collection');
    }
}
