<?php

namespace App\Livewire;

use App\Models\Role;
use App\Models\RoleTranslation;
use App\Models\User;
use Livewire\Component;
use App\Models\Permission;
use Livewire\WithPagination;

class RoleManagement extends Component
{
    use WithPagination;

    public $roleNameAr,$roleNameEn, $roleId, $permissions = [];
    public $isEditMode = false;
    public $showAddRoleForm = false;
    public $showEditRoleForm = false;

    protected $rules = [
        'roleNameAr' => 'required|string|max:255',
        'roleNameEn' => 'required|string|max:255',
        'permissions' => 'array',
    ];

    public function addRole()
    {
        $this->reset(['roleNameAr','roleNameEn', 'permissions']);
        $this->dispatch('show-add-role-modal');
    }

    public function saveRole()
    {
        $this->validate();
        
        $role = Role::create(['name' => $this->roleNameEn]);
        
        RoleTranslation::create([
            'role_id' =>  $role->id, 
            'locale' => 'ar' , 
            'name' => $this->roleNameAr
            ]);
            
        RoleTranslation::create([
            'role_id' =>  $role->id , 
            'locale' => 'en' , 
            'name' => $this->roleNameEn
            ]);
                
                
        $role->permissions()->sync($this->permissions); // attach permissions to the role

        $this->dispatch('hide-role-modal');
        session()->flash('message', 'Role added successfully.');
    }

    public function editRole($id)
    {
        $role = Role::find($id);
        $this->roleId = $role->id;
        $arRoleTranslation = RoleTranslation::where('role_id' ,$this->roleId )->where('locale' , 'ar')->first();
        $enRoleTranslation = RoleTranslation::where('role_id' ,$this->roleId )->where('locale' , 'en')->first();
        $this->roleNameEn = $enRoleTranslation->name;
        $this->roleNameAr = $arRoleTranslation->name;
            
        $this->roleName = $role->name;
        $this->permissions = $role->permissions->pluck('id')->toArray(); 

        $this->dispatch('show-edit-role-modal');
    }

    public function updateRole()
    {
        $this->validate([
            'roleNameEn' => 'required|string|max:255|unique:roles,name,' . $this->roleId,
            'permissions' => 'array',
        ]);

        $role = Role::find($this->roleId);
        $role->update(['name' => $this->roleNameEn]);
                
            $arRoleTranslation = RoleTranslation::where('role_id' ,$this->roleId )->where('locale' , 'ar')->first();
            $enRoleTranslation = RoleTranslation::where('role_id' ,$this->roleId )->where('locale' , 'en')->first();

            $arRoleTranslation->update([
                'name' => $this->roleNameAr
                ]);
                
                 $enRoleTranslation->update([
                'name' => $this->roleNameEn
                ]);
                
                
                
        $role->permissions()->sync($this->permissions); // update permissions for the role

        $this->dispatch('hide-role-modal');
        session()->flash('message', 'Role updated successfully.');
    }

    public function deleteRole($id)
    {
        // remove all permissions associated with this role
        $role = Role::find($id);
        if ($role) {
            $role->permissions()->detach(); 
            $role->delete(); 
            session()->flash('message', 'Role deleted successfully.');
        } else {
            session()->flash('error', 'Role not found.');
        }
    }
    
    

    public function render()
    {
        $roles = Role::paginate(10);
        $permissions = User::all(); 

        return view('livewire.role-management', ['roles' => $roles, 'permissions' => $permissions]);
    }
}