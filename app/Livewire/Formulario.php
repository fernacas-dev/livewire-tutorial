<?php

namespace App\Livewire;

use App\Livewire\Forms\PostCreateForm;
use App\Livewire\Forms\PostEditForm;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Formulario extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $categories, $tags;

    public $category_id = '', $title, $content;

    public $selectedTags = [];

    // public $posts = [];

    public $open = false;

    public PostCreateForm $postCreate;

    public PostEditForm $postEdit;

    public $postEditId = '';

    #[Url(as: 's')]
    public $search = '';

    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }

    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
        // $this->posts = Post::all();
    }

    // public function updating($property, $value)
    // {
    //     if($property == 'postCreate.category_id') {
    //         if($value > 3) {
    //             throw new \Exception('No puedes seleccionar esta categoria');
    //         }
    //     }
    // }

    // public function updated($property, $value)
    // {
    // }

    // public function hydrate()
    // {

    // }

    // public function dehydrate()
    // {

    // }

    public function save()
    {
        $this->postCreate->save();
        // $this->posts = Post::all();

        $this->resetPage(pageName:'pagePosts');
        $this->dispatch('post-created', 'Nuevo articulo creado');
    }

    public function edit(int $postId)
    {
        $this->resetValidation();
        $this->postEdit->edit($postId);
    }

    public function update()
    {
        $this->postEdit->update();
        $this->reset(['postEditId', 'open']);
        // $this->posts = Post::all();

        $this->dispatch('post-created', 'Articulo actualizado');
    }

    public function destroy(int $postId)
    {
        $post = Post::find($postId);
        $post->delete();
        $this->dispatch('post-created', 'Articulo eliminado');
        // $this->posts = Post::all();
    }

    public function render()
    {
        $posts = Post::orderBy('id', 'desc')
            ->when($this->search, function($query) {
                $query->where('title', 'like', '%'.$this->search.'%');
            })
            ->paginate(5, pageName: 'pagePosts');

        return view('livewire.formulario', compact('posts'));
    }
}
