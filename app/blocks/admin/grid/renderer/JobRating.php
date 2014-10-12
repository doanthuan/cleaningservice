<?php
namespace App\Blocks\Admin\Grid\Renderer;


class JobRating implements \Goxob\Core\Block\Grid\RendererInterface{
    public function render($row)
    {
        $html = '<div class="job-rating" data-score="'.$row->rating.'"></div>';
        return $html;
    }
}