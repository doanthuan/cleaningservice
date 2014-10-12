<?php
namespace Goxob\Core\Model;

use File, DB, Input, Validator;
use Goxob\Core\Model\Model;
use Goxob\Core\Model\UploadableInterface;

abstract class UploadableModel extends Model implements UploadableInterface
{
    protected $uploadPath;
    protected $file;
    protected $fileField;

    protected  $uploadRules = array(
        'file' => 'mimes:png,gif,jpeg|max:20000'
    );

    public function __construct(array $attributes = array(), $file = null)
    {
        if(isset($file))
        {
            $this->file = $file;
        }
        parent::__construct($attributes);
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function save(array $options = array())
    {
        //upload file
        $file = $this->file;
        if(isset($file)){
            $validator = Validator::make(array('file'=> $file), $this->uploadRules);
            if($validator->passes()){

                $filename = \Goxob\Core\Helper\File::formatFileName($file);
                $file->move($this->getBasePath(), $filename);

                //set file name
                $this->bindDataForSave($filename);
            }
            else {
                $this->setErrors($validator->messages());
                return false;
            }
        }

        return parent::save($options);
    }

    protected function bindDataForSave($filename)
    {
        if(!isset($this->fileField))
        {
            throw new \Exception('$fileField property must be provided');
        }
        $fileField = $this->fileField;
        $this->$fileField = $filename;
    }

    public function delete()
    {
        //remove image file
        File::delete( $this->getBasePath().'/'. $this->img_name);

        return parent::delete();
    }

    public function getAbsSrc()
    {
        if(!isset($this->fileField))
        {
            throw new \Exception('$fileField property must be provided');
        }
        $fileField = $this->fileField;
        return $this->getBaseUrl().'/'.$this->$fileField;
    }
}