<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoContato;
use Illuminate\Validation\Rule;

class TipoContatosController extends Controller
{

    private function getDefaultValues($tipocontato = null, $request = null)
    {
        return [
            'nome' => $tipocontato ? old('nome', $tipocontato->nome) : old('nome', ''),
            'descricao' => $tipocontato ? old('descricao', $tipocontato->descricao) : old('descricao', ''),
        ];
    }

    public function index()
    {
        $tipocontatos = TipoContato::orderBy('created_at', 'desc')->get();

        return view('tipocontatos.index', compact('tipocontatos'));
    }

    public function create()
    {
        $defaultValues = $this->getDefaultValues();

        return view('tipocontatos.create', compact('defaultValues'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:80|unique:tipo_contatos,nome',
            'descricao' => 'nullable|string',
        ]);

        $tipocontato = TipoContato::create($validated);

        return redirect()->route('tipocontatos.index')
            ->with('success', 'Tipo de contato criado com sucesso!');
    }

    public function show(string $id)
    {
        $tipocontato = TipoContato::findOrFail($id);
        return view('tipocontatos.show', compact('tipocontato'));
    }

    public function edit(string $id)
    {
        $tipocontato = TipoContato::findOrFail($id);

        $defaultValues = $this->getDefaultValues($tipocontato);

        return view('tipocontatos.edit', compact('tipocontato', 'defaultValues'));
    }

    public function update(Request $request, string $id)
    {
        $tipocontato = TipoContato::findOrFail($id);

        $validated = $request->validate([
            'nome' => [
                'required',
                'string',
                'max:80',
                Rule::unique('tipo_contatos')->ignore($tipocontato->id),
            ],
            'descricao' => 'nullable|string',
        ]);

        $tipocontato->update($validated);

        return redirect()->route('tipocontatos.index')
            ->with('success', 'Tipo de contato atualizado com sucesso!');
    }

    public function destroy(string $id)
    {
        $tipocontato = TipoContato::findOrFail($id);

        if ($tipocontato->isInUse()) {
            return redirect()->route('tipocontatos.index')
                ->with('error', 'Não é possível excluir este tipo de contato porque está sendo usado por um ou mais contatos.');
        }

        $tipocontato->delete();

        return redirect()->route('tipocontatos.index')
            ->with('success', 'Tipo de contato excluído com sucesso!');
    }
}
