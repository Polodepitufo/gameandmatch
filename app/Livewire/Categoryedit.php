<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class Categoryedit extends Component
{
    //Propiedades públicas
    public $name = '';
    public Category $category;

    /**
     * Reglas de validación
     */
    protected function rules()
    {
        return [
            'name' => ['required', 'max:60', 'unique:' . Category::class],
        ];
    }

    /**
     * Inicia el estado del componente al ser instanciado
     */
    public function mount(Category $category)
    {
        $this->name = $category->name;
        $this->category = $category;
    }

    /**
     * Carga la vista correspondiente
     */
    public function render()
    {
        return view('livewire.categoryedit');
    }
    
    /**
     * Actualiza la información correspondiente
     */
    public function update()
    {
        // Se reinician la reglas de validación
        $this->resetValidation();
        // Se compueba que el nombre no se emplea para otras categorias
        $categoryComprobar = Category::where('id', $this->category['id'])->get();
        foreach ($categoryComprobar as $cat) {
            // Si el nombre es único, entonces hace la validación
            if ($cat->name != $this->name) {
                $this->validate();
            }
        }
        // Se actualiza y se guardan cambios
        $this->category['name'] = $this->name;
        $this->category->save();
        //Se emite un evento
        $this->dispatch('editCategory');
        session()->put('status', 'Categoría editada correctamente.');
    }

    /**
     * Borra la información almacenada en sesión
     */
    public function deleteSession()
    {
        session()->forget('status');
    }
}
