<?php

namespace App;

use App\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PanelProduct extends Product
{

    

    use HasFactory;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        
    }

    public function getForeignKey()
    {
        $parent = get_parent_class($this);

        return (new $parent)->getForeignKey();
    }

    public function getMorphClass()
    {
        $parent = get_parent_class($this);
        
        return (new $parent)->getMorphClass();
    }
    
        
    
}
