<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KenFile extends Model
{
    protected $fillable = ['path'];


    /**
     * Get the URL for the file.
     *
     * @return string The URL of the file.
     */
    public function url()
    {
        $path = $this->getAttribute('path');
        return $path ? url('storage/' . $path) : '';
    }
}
