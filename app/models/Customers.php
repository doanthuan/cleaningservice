<?php
namespace App\Models;

use DB;
class Customers extends \Goxob\Core\Model\ModelList{

    public function getAll()
    {
        $query = $this->getSelect();
        $query->addSelect(DB::raw('CONCAT(first_name,\' \', last_name) as customer_name'));
        return $query->get();
    }
}