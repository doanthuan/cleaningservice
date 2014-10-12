
<?php echo Form::open(array('name' => 'adminForm'))?>
<div id="grid">
    <?php
    $filterable = is_object($items);
    if($filterable){ ?>
        <div class="paginator-row">
            <div class="row">
                <div class="col-md-9">
                    {{$items->links()}}
                    <span class="separator"></span>
                    <span> {{trans('Display')}} <?php echo \Goxob\Core\Helper\Html::paginateLimitBox(); ?></span>
                    <span class="separator"></span>
                    <span> {{trans('Total')}} <?php echo $items->getTotal(); ?> {{trans('records found')}} </span>
                </div>
                <div class="col-md-3 text-right">
                    <button type="button" class="btn btn-sm btn-primary" onclick="submitbutton('setFilter')">{{trans('Search')}}</button>
                    <button type="button" class="btn btn-sm btn-primary" onclick="submitbutton('resetFilter')">{{trans('Reset Filter')}}</button>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="grid">
        <table class="table table-striped table-bordered table-hover table-condensed">
            <!-- header -->
            <thead>
            <tr>
                <th width="20px"><input type="checkbox" name="toggle" value="" onclick="checkAll('<?php echo count($items);?>');" id="cbCheckAll"/></th>
                <?php foreach($columns as $column ){
                    $class = isset($column['class'])?$column['class']:'';
                    $width = isset($column['width'])?$column['width']:'';
                    ?>

                    <th class="<?php echo $class;?>" width="<?php echo $width;?>">
                        <?php
                        if( (isset($column['sortable']) && $column['sortable'] == false) || !$filterable){
                            echo '<a href="#">'.$column['header'].'</a>';
                        }
                        else{
                            echo \Goxob\Core\Helper\Html::gridSort($column['header'], $column['name'], $filters['filter_order_dir'], $filters['filter_order']);
                        }
                        if(isset($column['sort_order']) && $column['sort_order'] == true)
                        {
                            echo '<a href="#" onclick="return saveSortOrder(\'saveSortOrder\', \''.count($items).'\')" class="saveorder" title="Save Order"></a>';
                        }
                        ?></th>
                <?php } ?>
                @if($grid->actionCol)
                <th><a href="#">{{trans('Action')}}</a></th>
                @endif
            </tr>
            </thead>
            <!-- header end -->

            <tbody>
            <!-- filter row-->
            <?php if($filterable){ ?>
            <tr class="filter">
                <td></td>
                <?php foreach($columns as $column ){
                    if(isset($column['filter_type']))
                    {
                        if(!isset($filters["filter_{$column['name']}"])){
                            $filters["filter_{$column['name']}"] = null;
                        }
                        if(!isset($filters["filter_{$column['name']}_from"])){
                            $filters["filter_{$column['name']}_from"] = null;
                        }
                        if(!isset($filters["filter_{$column['name']}_to"])){
                            $filters["filter_{$column['name']}_to"] = null;
                        }
                        if($column['filter_type'] == 'range')
                        if($column['filter_type'] == 'range')
                        {?>
                            <td>
                                <div class="range">
                                    <div class="range-line">
                                        <?php echo Form::text("filter_{$column['name']}_from",$filters["filter_{$column['name']}_from"], array('placeholder'=> 'From', 'class' => 'form-control range'));?>
                                    </div>
                                    <div class="range-line">
                                        <?php echo Form::text("filter_{$column['name']}_to",$filters["filter_{$column['name']}_to"], array('placeholder'=> 'To', 'class' => 'form-control search'));?>
                                    </div>
                                </div>
                            </td>
                        <?php
                        }

                        if($column['filter_type'] == 'text')
                        {?>
                            <td>
                                <?php echo Form::text("filter_{$column['name']}",$filters["filter_{$column['name']}"], array('class' => 'form-control filter', 'placeholder' => trans('Search')));?>
                            </td>
                        <?php
                        }

                        if($column['filter_type'] == 'dropdown')
                        {?>
                            <td>
                                <?php
                                if(is_null($column['filter_data']['collection']))
                                {
                                    throw new Exception('Collection dropdown could not be empty');
                                }
                                if(!isset($column['filter_data']['field_value']))
                                {
                                    $column['filter_data']['field_value'] = null;
                                }
                                if(!isset($column['filter_data']['field_name']))
                                {
                                    $column['filter_data']['field_name'] = null;
                                }
                                if(!isset($column['filter_data']['extraOptions']))
                                {
                                    $column['filter_data']['extraOptions'] = array();
                                }
                                if(!isset($filters['filter_'.$column['filter_index']]))
                                {
                                    $filters['filter_'.$column['filter_index']] = null;
                                }
                                echo \Goxob\Core\Helper\Html::dropdown('filter_'.$column['filter_index'],
                                    $filters['filter_'.$column['filter_index']],
                                    array('onchange' => "submitbutton('setFilter')", 'class' => ''),
                                    $column['filter_data']['collection'],
                                    $column['filter_data']['field_value'],
                                    $column['filter_data']['field_name'],
                                    $column['filter_data']['extraOptions']
                                )
                                ?>
                            </td>
                        <?php
                        }

                        if($column['filter_type'] == 'date_range')
                        {?>
                            <td>
                                <?php echo Form::select('filter_'.$column['filter_index'], $column['options'],
                                    $filters['filter_'.$column['filter_index']],
                                    array('onchange' => "submitbutton('setFilter')", 'class' => ''))?>
                            </td>
                        <?php
                        }

                    }else{
                        echo '<td></td>';
                    }
                    ?>
                <?php
                }
                ?>
                @if($grid->actionCol)
                <td></td>
                @endif
            </tr>
            <?php } ?>
            <!-- filter row end-->

            <!-- data rows-->
            <?php
            if(count($items) > 0){
                foreach ($items as $i => $item) {?>
                    <tr>
                        <?php echo '<td>'.'<input type="checkbox" id="cb' . $i . '" name="cid[]" value="' . $item[$keyCol]. '"  />'.'</td>' ;?>
                        <?php foreach($columns as $column ){

                            if(isset($column['renderer']))
                            {
                                $obj = $column['renderer'];
                                echo '<td>'.$obj->render($item).'</td>';
                            }
                            else if($column['name'] == 'status' && isset($column['sort_order']) && $column['sort_order'] == true)
                            {
                                echo '<td>'.\Goxob\Core\Helper\Html::gridSortOrder($item->sort_order).'</td>';
                            }
                            else if($column['name'] == 'status' && isset($column['published']) && $column['published'] == true)
                            {
                                echo '<td>'.\Goxob\Core\Helper\Html::gridPublish($item->status, $i).'</td>';
                            }
                            else if (DateTime::createFromFormat('Y-m-d H:i:s', $item[$column['name']]) !== FALSE) {
                                // it's a date
                                //echo '<td>'.date('M d, Y H:i', strtotime($item[$column['name']])).'</td>';
                                echo '<td>'.$item[$column['name']].'</td>';
                            }
                            else
                            {
                                echo '<td>'.$item[$column['name']].'</td>';
                            }
                        } ?>
                        @if($grid->actionCol)
                        <td class="{{$grid->actionColCls}}"><?php echo $grid->getActionLinks($item, $i)?></td>
                        @endif
                    </tr>
                <?php }
            }
            ?>
            <!-- data rows end-->
            </tbody>

        </table>
    </div>
</div>


<input type="hidden" name="filter_order" id="filter_order" value="" />
<input type="hidden" name="filter_order_dir" id="filter_order_dir" value="" />

<input type="hidden" name="task" value="" id="task"/>
<input type="hidden" name="boxchecked" id="boxchecked" value="0" />
<input type="hidden" name="params" id="params" />

<?php echo Form::close();?>