<?php
namespace App\Blocks\Admin\Grid\Renderer;


class JobAmount implements \Goxob\Core\Block\Grid\RendererInterface{
    public function render($row)
    {
        //return \App\Models\Job::getStatusString($row->amount);
        return '$'.number_format($row->amount, 1);
    }
}