<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Idea;
use App\Models\Category;
use Illuminate\Http\Response;

class CreateIdea extends Component
{
    public $title;
    public $category_id = 1;
    public $category;
    public $description;

    protected $rules = [
        'title' => 'required|min:6',
        'category_id' => 'required|integer',
        'description' => 'required',
    ];

    protected $messages = [
        'title.required' => 'Campo obrigatório',
        'title.min' => 'Deve ter no mínimo 6 caracteres',
        'description.required' => 'Campo obrigatório',
    ];

    public function createIdea()
    {
        if (!Auth::check()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->validate();

        Idea::create([
            'user_id' => Auth::id(),
            'category_id' => $this->category_id,
            'title' => $this->title,
            'description' => $this->description
        ]);

        session()->flash('success_message', 'Ideia criada com sucesso!');

        $this->reset();

        return redirect()->route('idea.index');
    }

    public function render()
    {
        return view('livewire.create-idea', [
            'categories' => Category::all()
        ]);
    }
}
