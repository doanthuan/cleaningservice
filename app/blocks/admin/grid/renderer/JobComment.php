<?php
namespace App\Blocks\Admin\Grid\Renderer;


class JobComment implements \Goxob\Core\Block\Grid\RendererInterface{
    public function render($row)
    {
        $comment = $row->comment;
        if(strlen($comment) > 30){
            $comment = \Str::limit($comment, 30).'...';
        }
        $link = '<a href="javascript:popupComment(\''.$row->job_id.'\')">Details</a>';
        return $comment.$link;
    }
}