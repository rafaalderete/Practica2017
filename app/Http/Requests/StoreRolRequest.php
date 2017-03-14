<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Permission as Permiso;

class StoreRolRequest extends Request
{

    const CAMPO_NOMBRE_ROL = 'Nombre Rol';
    const CAMPO_NOMBRE_AMIGABLE_ROL = 'Nombre Amigable Rol';
    const CAMPO_PERMISOS = 'Permisos';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      $permisos = Permiso::all()->where('estado_permiso', 'activo');

      $permisos_disponibles = 'in:'.$permisos[0]->id;
      for ($x = 1; $x < sizeof($permisos); $x++) {
          $permisos_disponibles = $permisos_disponibles.','.$permisos[$x]->id;
      }

      return [
          'name' => 'min:4|max:20|required|unique:roles',
          'nombre_amigable_rol' => 'min:4|max:20|required',
          'permisos[]' => $permisos_disponibles
      ];
    }

    public function messages()
    {
      return [
          'name.min' => 'El campo '.self::CAMPO_NOMBRE_ROL.' debe contener al menos 4 caracteres.',
          'name.max' => 'El campo '.self::CAMPO_NOMBRE_ROL.' debe contener 20 caracteres como máximo.',
          'name.unique' => 'El elemento '.self::CAMPO_NOMBRE_ROL.' ya está en uso.',
          'nombre_amigable_rol.min' => 'El campo '.self::CAMPO_NOMBRE_AMIGABLE_ROL.' debe contener al menos 4 caracteres.',
          'nombre_amigable_rol.max' => 'El campo '.self::CAMPO_NOMBRE_AMIGABLE_ROL.' debe contener 20 caracteres como máximo.',
          'permisos[].in' => 'Datos invalidos para el campo '.self::CAMPO_PERMISOS,
      ];
    }

}
