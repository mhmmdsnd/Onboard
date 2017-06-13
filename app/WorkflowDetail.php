<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkflowDetail extends Model
{
    protected $table = "workflow_detail";

    /**
     * @return string
     */
    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }
}
