<?php
namespace App\Blocks\Admin\Grid\Renderer;


class JobStatus implements \Goxob\Core\Block\Grid\RendererInterface{
    public function render($row)
    {
        return \App\Models\Job::getStatusString($row->status);
    }
}