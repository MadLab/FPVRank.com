<div class="form-group row">
    <label class="col-md-4 col-form-label text-md-right"> </label>
    <div class="col-md-3 text-center">
        <label>Create data</label>
    </div>
    <div class="col-md-3 text-center">
        <label>Edit data</label>
    </div>
</div>
@component('components.permissions')
@slot('labelTitle')
UserController
@endslot
@slot('createName')
userCreate
@endslot
@slot('createValue')
{{isset($permissions) ? $permissions->where('controller', '=', 'UserController')->first()->create : '0'}}
@endslot
@slot('editValue')
{{isset($permissions) ? $permissions->where('controller', '=', 'UserController')->first()->edit : '0'}}
@endslot
@slot('editName')
userEdit
@endslot
@endcomponent
<!-- -->
@component('components.permissions')
@slot('labelTitle')
ClassController
@endslot
@slot('createName')
classCreate
@endslot
@slot('createValue')
{{isset($permissions) ? $permissions->where('controller', '=', 'ClassController')->first()->create : '0'}}
@endslot
@slot('editValue')
{{isset($permissions) ? $permissions->where('controller', '=', 'ClassController')->first()->edit : '0'}}
@endslot
@slot('editName')
classEdit
@endslot
@endcomponent
<!-- -->
@component('components.permissions')
@slot('labelTitle')
PilotController
@endslot
@slot('createName')
pilotCreate
@endslot
@slot('createValue')
{{isset($permissions) ? $permissions->where('controller', '=', 'PilotController')->first()->create : '0'}}
@endslot
@slot('editValue')
{{isset($permissions) ? $permissions->where('controller', '=', 'PilotController')->first()->edit : '0'}}
@endslot
@slot('editName')
pilotEdit
@endslot
@endcomponent
<!-- -->
@component('components.permissions')
@slot('labelTitle')
EventController
@endslot
@slot('createName')
eventCreate
@endslot
@slot('createValue')
{{isset($permissions) ? $permissions->where('controller', '=', 'EventController')->first()->create : '0'}}
@endslot
@slot('editValue')
{{isset($permissions) ? $permissions->where('controller', '=', 'EventController')->first()->edit : '0'}}
@endslot
@slot('editName')
eventEdit
@endslot
@endcomponent
