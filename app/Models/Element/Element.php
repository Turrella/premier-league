<?php

namespace App\Models\Element;


use App\Models\BaseModel;
use App\Models\Team\Team;
use Illuminate\Database\Eloquent\Model;

class Element extends BaseModel
{
    public function team()
    {
        return $this->belongsTo(Team::class, 'team');
    }

    public function elementType()
    {
        return $this->belongsTo(ElementType::class, 'element_type');
    }

}
