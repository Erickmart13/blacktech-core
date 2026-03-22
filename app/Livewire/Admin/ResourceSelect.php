<?php

namespace App\Livewire\Admin;

use App\Models\Admin\Module;
use App\Models\Admin\Resource;
use Livewire\Component;

class ResourceSelect extends Component
{

    public $module_id;      // módulo seleccionado
    public $parent_id;      // resource padre seleccionado
    public $modules = [];   // lista de módulos
    public $parents = [];   // lista de recursos padre del módulo

    public function mount($selectedModule = null, $selectedParent = null)
    {
        $this->modules = Module::orderBy('order')->get();
        $this->module_id = $selectedModule;
        $this->parent_id = $selectedParent;

        if ($this->module_id) {
            $this->loadParents();
        }
    }

    public function updatedModuleId($value)
    {
        // ¿Muestra el id del módulo seleccionado?
        $this->loadParents();
        $this->parent_id = null; // resetear selección al cambiar módulo
    }

    protected function loadParents()
    {
        if (!$this->module_id) {
            $this->parents = [];
            return;

            $this->parents = Resource::tree($this->module_id);
            // ¿Muestra los recursos del módulo?
        }

        // 🔹 Usando el tree para jerarquía
        $this->parents = Resource::tree($this->module_id);
    }


    public function render()
    {
        return view('livewire.admin.resource-select');
    }
}
