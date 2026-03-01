<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validar que se cree bien
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        //si pasa la validación creara el rol
        Role::create([
            'name' => $request->name
        ]);

        //Confirmación de operacion exitosa
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Rol creado correctamente',
            'text' => 'El rol se ha creado correctamente'
        ]);

        //redicionar a la tablas principal
        return redirect(route('admin.roles.index'))->with('success', 'Rol created successfully');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //Validar que se inserte bien y que excluya la fila que edita
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        //si pasa la validación editará el rol
        $role->update([
            'name' => $request->name
        ]);

        //Confirmación de operacion exitosa
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Rol actualizado correctamente',
            'text' => 'El rol ha sido modificado correctamente'
        ]);

        //Redireccionar a la misma vista de editar
        return redirect(route('admin.roles.edit', $role));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        //Confirmación de operacion exitosa
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Rol eliminado correctamente',
            'text' => 'El rol ha sido eliminado correctamente'
        ]);

        //Redireccionar a la tabla principal
        return redirect(route('admin.roles.index'));
    }
}
