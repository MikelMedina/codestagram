<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Number;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $cantidad;


    public function mount() {
        //comprobar si el usuario ha dado like o no
        $this->isLiked = $this->post->checkLike(auth()->id());
        $this->cantidad = Number::abbreviate($this->post->likes()->count());
    
    }


    
    public function like()
    {
   
        //comprobar si el usuario ya le ha dado like
        if($this->post->likes()->where('user_id', auth()->id() ?? null)->doesntExist()) {

            //crear el registro de like
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);

            $this->isLiked = true;
        } else {
            $this->post->likes()->where('user_id', auth()->id())->delete();
            $this->isLiked = false;
        }
        
        // Recalcular la cantidad desde la BD
        $this->cantidad = Number::abbreviate($this->post->likes()->count());
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
