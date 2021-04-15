<?php

namespace App\Models\Element;

use App\Models\BaseModel;

class ElementType extends BaseModel
{

    public function element()
    {
        return $this->hasMany(Element::class, 'element_type');
    }
}
