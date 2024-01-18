<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class Categoryedit extends Component
{
    public $name = '';
    public Category $category;

    protected function rules()
    {
        return [
            'name' => ['required','max:60', 'unique:' . Category::class],
        ];
    }
    public function mount(Category $category)
    {
        $this->name = $category->name;
        $this->category = $category;
    }

    public function render()
    {
        return view('livewire.categoryedit');
    }
    
    public function update()
    {
        $this->resetValidation();
        $categoryComprobar = Category::where('id', $this->category['id'])->get();
        foreach ($categoryComprobar as $cat) {

            if ($cat->name != $this->name) {
                $this->validate();
            }
        }
        $this->category['name'] = $this->name;
        $this->category->save();
        $this->dispatch('editCategory');
        session()->put('status', 'Categoría editada correctamente.');
    }
    public function deleteSession(){
        session()->forget('status');
    }
}
