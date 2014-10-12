<?php
namespace Goxob\Core\Block;
use Controller, View, Session, Input;

class Grid extends BaseBlock{

    protected $defaultTemplate = 'admin.layouts.partials.grid';

    protected $columns;

    protected $keyCol;

    public $actionCol = true;
    public $actionColCls = '';

    protected function addColumn($data)
    {
        $this->columns[] = $data;
    }
    protected function setCollection($collection)
    {
        $this->items = $collection;
    }

    protected function prepareData()
    {
        $this->prepareColumns();
        $items = $this->prepareCollection();

        $data['columns'] = $this->columns;
        $data['keyCol'] = $this->keyCol;
        $data['items'] = $items;
        $data['filters'] = Session::get('grid_filters');
        $data['grid'] = $this;
        return $data;
    }

    protected function prepareColumns()
    {
        throw new \Exception('prepareColumns() method has not been implemented');
    }

    protected function prepareCollection()
    {
        throw new \Exception('prepareCollection() method has not been implemented');
    }


    public function getActionLinks($item, $i)
    {
        $editUrl = Session::get('editUrl');
       // $editLink = '<a href="'.$editUrl.'?id='.$item->getKey().'">'.trans('Edit').'</a>';
        
        $editLink = '<a class="btn btn-sm btn-info" href="'.$editUrl.'?id='.$item->getKey().'"><i class="fa fa-pencil-square-o"></i></a>';
        return $editLink;
    }

    protected function gridFilter(&$query)
    {
        $input = Session::get('grid_filters');
        if(isset($input) && count($input) > 0)
        {
            $tableName = $query->getModel()->getTable();

            #order by
            if(!empty($input['filter_order']) && !empty($input['filter_order_dir']))
            {
                //remove default orderby
                $query->getQuery()->orders = null;
                //order by
                $query->orderBy($input['filter_order'], $input['filter_order_dir']);
            }
            foreach($this->columns as $column)
            {
                if(isset($column['filter_type']))
                {
                    $filterColumn = isset($column['filter_index'])?$column['filter_index']:"{$tableName}.{$column['name']}";

                    if($column['filter_type'] == 'range')
                    {
                        $from = isset($input["filter_{$column['name']}_from"])?$input["filter_{$column['name']}_from"]:"";
                        $to = isset($input["filter_{$column['name']}_to"])?$input["filter_{$column['name']}_to"]:"";

                        if(!empty($from) && is_numeric($from) )
                        {
                            $query->where($filterColumn,'>=', $from);
                        }
                        if(!empty($to) && is_numeric($to) )
                        {
                            $query->where($filterColumn,'<=', $to);
                        }
                    }

                    if($column['filter_type'] == 'text')
                    {

                        if(!empty($input["filter_{$column['name']}"]))
                        {
                            $key = $input["filter_{$column['name']}"];
                            $query->where($filterColumn,'like', '%'.$key.'%');
                        }
                    }
                    if($column['filter_type'] == 'dropdown')
                    {
                        if(!isset($input['filter_'.$filterColumn]) || empty($input['filter_'.$filterColumn]))
                        {
                            continue;
                        }

                        $value = $input['filter_'.$filterColumn];

                        if($filterColumn == 'category_id' )//for category only
                        {
                            if(!empty($value)){
                                $categoryIds = \Goxob::getModel('catalog/categories')->getChildrenIds($value);
                                $query->whereIn("{$tableName}.category_id", $categoryIds);
                            }
                        }
                        else if(strlen($value) > 0)
                        {
                            $query->where("{$tableName}.{$column['filter_index']}",'=', $value);
                        }
                    }
                    if($column['filter_type'] == 'date_range')
                    {
                        if(!isset($input['filter_'.$filterColumn]))
                        {
                            continue;
                        }

                        $range = $input['filter_'.$filterColumn];
                        if($range == 'day')
                        {
                            $query->whereRaw('date('.$filterColumn.') = date(CURRENT_DATE)');
                        }
                        if($range == 'week')
                        {
                            $query->whereRaw('WEEKOFYEAR('.$filterColumn.' )= WEEKOFYEAR(NOW())');
                            $query->whereRaw('YEAR('.$filterColumn.') = YEAR(CURRENT_DATE)');
                        }
                        if($range == 'month')
                        {
                            $query->whereRaw('MONTH('.$filterColumn.') = MONTH(CURRENT_DATE)');
                            $query->whereRaw('YEAR('.$filterColumn.') = YEAR(CURRENT_DATE)');
                        }
                        if($range == 'year')
                        {
                            $query->whereRaw('YEAR('.$filterColumn.') = YEAR(CURRENT_DATE)');
                        }
                    }
                }
            }
        }
    }

    /**
     * @param $query
     * is a ModelList object or Laravel Query Builder
     * @return mixed
     */
    public function getData($query)
    {
        if($query instanceof \Goxob\Core\Model\ModelList)
        {
            $query = $query->getSelect();
        }
        $this->gridFilter($query);

        $defaultPageSize = 20;
        $pageSize = Input::get('limit', $defaultPageSize);
        $curPage = \Paginator::getCurrentPage();


        // clone the query to make 100% sure we don't have any overwriting
        $itemQuery = clone $query;
        //$itemQuery->addSelect('posts.*');
        // this does the sql limit/offset needed to get the correct subset of items
        $items = $itemQuery->forPage($curPage, $pageSize)->get();

        // manually run a query to select the total item count
        // use addSelect instead of select to append
        $totalResult = $query->addSelect(\DB::raw('count(*) as count'))->get();
        $totalItems = $totalResult[0]->count;

        // make the paginator, which is the same as returned from paginate()
        // all() will return an array of models from the collection.
        $pagination = \Paginator::make($items->all(), $totalItems, $pageSize);

        //$pagination = $query->paginate($pageSize);
        $pagination->appends(array_except(Input::query(), 'page'));
        return $pagination;
    }
}