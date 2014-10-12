<?php
namespace App\Blocks\Admin\Grid\Renderer;


class JobAddress implements \Goxob\Core\Block\Grid\RendererInterface{
    public function render($row)
    {
        $address = $row->address;
        if(strlen($address) > 30){
            return \Str::limit($address, 30).'...';
        }
        return $address;
    }
}