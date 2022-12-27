# Role and Permission Handling

* The application is use spartie

## Example

````php
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable

{

    use HasRoles;
````

````php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

$role = Role::create(['name' => 'writer']);
$permission = Permission::create(['name' => 'edit articles']);
$users = User::permission('edit articles')->get(); 
````

````php
@can('edit articles')
  //
@endcan

@if(auth()->user()->can('edit articles') && $some_other_condition)
  //
@endif

@role('writer')
    I am a writer!
@else
    I am not a writer...
@endrole

@hasrole('writer')
    I am a writer!
@else
    I am not a writer...
@endhasrole

@hasanyrole('writer|admin')
    I am either a writer or an admin or both!
@else
    I have none of these roles...
@endhasanyrole
````

For Middelware see https://spatie.be/docs/laravel-permission/v5/basic-usage/middleware

see also https://github.com/balajidharma/basic-laravel-admin-panel/blob/archive/1.0.5/resources/views/admin/role/create.blade.php

## Add Role to user in DB

INSERT INTO model_has_roles (role_id, model_type, model_id) VALUES (4, 'App\\Models\\User', 1);
