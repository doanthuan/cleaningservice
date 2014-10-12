<?php
namespace App\Blocks\Admin\Grid\Renderer;


class JobComment implements \Goxob\Core\Block\Grid\RendererInterface{
    public function render($row)
    {
        $comment = $row->comment;
        if(strlen($comment) > 30){
            return \Str::limit($comment, 30).'...';
        }
        return $comment;
    }
}