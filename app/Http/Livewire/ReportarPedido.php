<?php

namespace App\Http\Livewire;

use App\Models\Compra;
use App\Models\Queja;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReportarPedido extends Component
{
    public Compra $compra;
    public Usuario $usuario;
    public $mensaje;
    public Queja $queja;

    public $rules = [
        'mensaje' => 'required|max:100'
    ];

    public $messages = [
        'mensaje.required' => "Se require un mensaje",
        'mensaje.max' => "El mensaje es muy largo"
    ];

    public function mount($id)
    {
        if ($id != null) {
            $this->compra = Compra::findOrFail($id);
        } else {
            $this->compra = new Compra();
        }
        if($this->compra->queja != null){
            abort(403, 'Ya se levantó esta queja');
        }
    }

    public function render()
    {
        $this->usuario = Usuario::where('id_user', '=', Auth::id())
            ->first();

        return view('livewire.reportar-pedido');
    }

    public function save()
    {
        $this->validate($this->rules, $this->messages);
        $this->queja = new Queja();
        $this->queja->id_usuario = $this->usuario->id_usuario;
        $this->queja->id_compra = $this->compra->id_compra;
        $this->queja->estatus = 0;
        $this->queja->mensaje = $this->mensaje;
        $this->queja->save();

        return redirect(route('mis-estadisticas'));
    }
}
