<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'todos';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
