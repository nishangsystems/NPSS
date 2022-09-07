<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Student extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'matricule' => $this->matricule,
            'class' => ($this->sClass(getYear()) != null)?
                ($this->sClass(getYear())->class->section->name.' - '.$this->sClass(getYear())->name):
                ($this->sClass($this->admission_year)->class->section->name.' - '.$this->sClass($this->admission_year)->class->name),
        ];
    }
}
