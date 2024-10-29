<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Permission;
use App\Models\PermissionTranslation;
use Livewire\WithPagination;

class PermissionManagement extends Component
{

        use WithPagination;
    
        public $permissionNameAr , $permissionNameEn, $permissionId;
        public $isEditMode = false;
    
        protected $rules = [
            'permissionNameEn' => 'required|string|max:255',
            'permissionNameAr' => 'required|string|max:255',

        ];
    
        public function addPermission()
        {
            $this->reset(['permissionNameEn' , 'permissionNameAr']);
            $this->dispatch('show-add-permission-modal');
        }
    
        public function savePermission()
        {
            $this->validate();
    
            $permission =  Permission::create(['name' => $this->permissionNameEn]);
    
                PermissionTranslation::create([
                'permission_id' =>  $permission->id, 
                'locale' => 'ar' , 
                'name' => $this->permissionNameAr
                ]);
                
                PermissionTranslation::create([
                'permission_id' =>  $permission->id , 
                'locale' => 'en' , 
                'name' => $this->permissionNameEn
                ]);
                
                
            $this->dispatch('hide-permission-modal');
            session()->flash('message', 'Permission added successfully.');
        }
    
        public function editPermission($id)
        {
            $permission = Permission::find($id);
            $this->permissionId = $permission->id;
            $arPermissionTranslation = PermissionTranslation::where('permission_id' ,$this->permissionId )->where('locale' , 'ar')->first();
            $enPermissionTranslation = PermissionTranslation::where('permission_id' ,$this->permissionId )->where('locale' , 'en')->first();
            $this->permissionNameEn = $enPermissionTranslation->name;
            $this->permissionNameAr = $arPermissionTranslation->name;

            $this->dispatch('show-edit-permission-modal');
        }
    
        public function updatePermission()
        {
            $this->validate([
                'permissionNameEn' => 'required|string|max:255|unique:permissions,name,' . $this->permissionId,
            ]);
    
            $permission = Permission::find($this->permissionId);
            $permission->update(['name' => $this->permissionNameEn]);
                
            $arPermissionTranslation = PermissionTranslation::where('permission_id' ,$this->permissionId )->where('locale' , 'ar')->first();
            $enPermissionTranslation = PermissionTranslation::where('permission_id' ,$this->permissionId )->where('locale' , 'en')->first();

            $arPermissionTranslation->update([
                'name' => $this->permissionNameAr
                ]);
                
                 $enPermissionTranslation->update([
                'name' => $this->permissionNameEn
                ]);
                
            $this->dispatch('hide-permission-modal');
            session()->flash('message', 'Permission updated successfully.');
        }
    
        public function deletePermission($id)
        {
            $permission = Permission::find($id);
            if ($permission) {
                $permission->delete();
                session()->flash('message', 'Permission deleted successfully.');
            } else {
                session()->flash('error', 'Permission not found.');
            }
        }
    
        public function render()
        {
            $permissions = Permission::paginate(10);
    
            return view('livewire.permission-management', ['permissions' => $permissions]);
        }
}
