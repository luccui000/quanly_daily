<?php

namespace App\Trait;

trait ToolComponent 
{
    public $showModal = false;
    public $modalTitle = '';
    public $isEdit = false;
    public function dispatchAlert($type, $title, $content = null)
    {
        return [
            'title' => $title,
            'content' => $content,
            'type' =>  $type
        ];
    } 
    public function edit()
    {   
        $this->showModal = true;
    }
    public function create()
    {
        $this->showModal = true;
    }
    public function save()
    {

    }
    public function deleteSelected()
    {

    }
    public function export()
    {

    }
}