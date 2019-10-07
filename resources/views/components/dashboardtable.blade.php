<div class="col-xl-6">
    <div class="card card-fluid">
        <div class="card-header border-0">
            <div class="d-flex align-items-center">
                <span class="mr-auto">{{$tableTitle}}</span>
                <div class="card-header-control">
                    <div class="dropdown">
                        <button type="button" class="btn btn-icon btn-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-fw fa-ellipsis-v"></i></button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-arrow"></div><a href="{{$routeCreate}}" class="dropdown-item">Create new</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{$tableContent}}
        <div class="card-footer">
            <a href="{{$routeList}}" class="card-footer-item">View List <i class="fa fa-fw fa-angle-right"></i></a>
        </div>
    </div>
</div>
