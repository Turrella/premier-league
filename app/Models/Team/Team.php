<?php

namespace App\Models\Team;


use App\Models\BaseModel;
use App\Models\Element\Element;

class Team extends BaseModel
{
    public function element()
    {
        return $this->hasMany(Element::class, 'team');
    }
}
