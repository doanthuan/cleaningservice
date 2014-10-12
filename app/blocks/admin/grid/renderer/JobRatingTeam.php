<?php
namespace App\Blocks\Admin\Grid\Renderer;


class JobRatingTeam implements \Goxob\Core\Block\Grid\RendererInterface{
    public function render($row)
    {
        $html = '<div class="job-rating" data-score="'.$row->avg_rating.'"></div>';
        return $html;
    }
}