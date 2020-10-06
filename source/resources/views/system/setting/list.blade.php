<div class="box box-solid" ng-cloak>
    <div class="box-body">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th width="15%">Title</th>
                    <th width="20%">Key</th>
                    <th width="30%">Value</th>
                    <th width="15%">Description</th>
                    <th width="10%"></th>
                </tr>
                <tr style="background-color: antiquewhite">
                    <td><input ng-model="newParam.title" style="width: 95%" type="text"/></td>
                    <td><input ng-model="newParam.key" style="width: 95%" type="text"/></td>
                    <td><input ng-model="newParam.value" style="width: 95%" type="text"/></td>
                    <td><textarea ng-model="newParam.description" style="width: 95%" rows="2"></textarea></td>
                    <td>
                        <button type="button" id="addParamButton" class="btn btn-success" ng-click="add()" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading..."><i class="fa fa-plus"></i> Add</button>
                    </td>
                </tr>
                <tr ng-repeat="param in settings">
                    <td>
                        <span ng-show="!param['edit']">@{{ param.title }}</span>
                        <input style="width: 95%" ng-show="param['edit']" type="text" ng-model="param['title']"/>
                    </td>
                    <td>
                        <span ng-show="!param['edit']">@{{ param.key }}</span>
                        <input style="width: 95%" ng-show="param['edit']" type="text" ng-model="param['key']"/>
                     </td>
                    <td style="overflow: scroll">
                        <span ng-show="!param['edit']" style="display: block; max-width: 300px; max-height: 100px;">@{{ param.value }}</span>
                        <textarea style="width: 95%" ng-show="param['edit']" rows="4" ng-model="param['value']"/></textarea>
                    </td>
                    <td>
                        <span ng-show="!param['edit']">@{{ param.description }}</span>
                        <textarea style="width: 95%" ng-show="param['edit'] " rows="4" ng-model="param['description']"/></textarea>
                    </td>
                    <td>
                        <a href="javascript:void(0)" ng-show="!param['edit']" class="btn btn-primary btn-sm" title="Edit this param" ng-click="showUpdate(param)">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="javascript:void(0)" ng-show="!param['edit']" class="btn btn-danger btn-sm" title="Remove this param" ng-click="delete(param)">
                           <i class="fa fa-times"></i>
                        </a>
                        <a href="javascript:void(0)" ng-show="param['edit']" class="btn btn-success btn-sm" ng-click="update(param)">
                            <i class="fa fa-save"></i> Save
                        </a>
                        <a href="javascript:void(0)" ng-show="param['edit']" class="btn btn-warning btn-sm" ng-click="cancelUpdate(param)">
                           <i class="fa fa-window-close"></i> Cancel
                        </a>
                    </td>
                </tr>
              </tbody>
          </table>
    </div>
</div>
