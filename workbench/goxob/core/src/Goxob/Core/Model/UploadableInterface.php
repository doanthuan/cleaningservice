<?php
namespace Goxob\Core\Model;

interface UploadableInterface {

    public function getBasePath();

    public function getBaseUrl();

    public function getAbsSrc();

}