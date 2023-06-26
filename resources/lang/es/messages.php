<?php

return [
    "registro_usuarios" => [
        "name.required"                 => "Por favor ingresa un nombre para el usuario",
        "name.string"                   => "El nombre no debe tener números",
        "name.max"                      => "El nombre es demasiado largo",
        "phone.required"                => "Por favor ingresa un teléfono",
        "phone.integer"                 => "Por favor, escribe un número de teléfono",
        "phone.digits"                  => "El teléfono debe tener 10 dígitos solamente",
        "phone.unique"                  => "Este teléfono ya está ocupado. Ingresa otro diferente",
        "password.required"             => "Por favor ingresa una contraseña",
        "password.confirmed"            => "Las contraseñas no coinciden",
        "password.length"               => "La contraseña es muy corta",
        "rol.required"                  => "Por favor selecciona un rol",
        "rol.integer"                   => "Por favor selecciona un rol",
        "almacen.required_if"           => "Por favor selecciona un almacén",
        "almacen.integer"               => "Por favor selecciona un almacén",
    ],
    "usuario_edit" => [
        "user.name.required"            => "Por favor ingresa un nombre para el usuario",
        "user.name.string"              => "El nombre no debe tener números",
        "user.name.max"                 => "El nombre es demasiado largo",
        "user.phone.required"           => "Por favor ingresa un teléfono",
        "user.phone.integer"            => "Por favor, escribe un número de teléfono",
        "user.phone.digits"             => "El teléfono debe tener 10 dígitos solamente",
        "user.phone.unique"             => "Este teléfono ya está ocupado. Ingresa otro diferente",
        "user.rol.required"             => "Por favor selecciona un rol",
        "user.rol.integer"              => "Por favor selecciona un rol"
    ],
    "caja_edit" => [
        "caja.id_almacen.required"      => "Por favor selecciona un almacén",
        "caja.id_almacen.integer"       => "Por favor selecciona un almacén",
        "caja.abierta.required"         => "Por favor selecciona un estatus",
        "caja.abierta.integer"          => "Por favor selecciona un estatus"
    ],
    "registrar_cliente" => [
        "clienteNuevo.nombre.required"       => "Se requiere el nombre del cliente",
        "clienteNuevo.nombre.string"         => "Se requiere el nombre del cliente",
        "clienteNuevo.telefono.required"     => "Se requiere el número de teléfono del cliente",
        "clienteNuevo.telefono.numeric"      => "Se requiere el número de teléfono del cliente",
        "clienteNuevo.telefono.digits"       => "El número del cliente debe ser de 10 dígitos",
        "clienteNuevo.correo.email"          => "Se requiere el correo electrónico del cliente"
    ],
    "pings" => [
        "vender_producto" => [
            "terminar"                      => "Terminó una compra: Total: $:total; Cambio: $:cambio",
            "registrar_cliente"             => "Registró al cliente con Id: :id; Nombre: :nombre",
            "abrir_caja"                    => "Abrió caja con $:apertura",
            "cerrar_caja"                   => "Cerró su caja con $:total",
        ],
        "usuarios" => [
            "editar_usuario"                => "Cambió el usuario :id con los siguientes datos: Nombre: :nombre; Teléfono: :telefono; Rol: :rol",
            "crear_usuario"                 => "Creó el usuario :id con los siguientes datos: Nombre: :nombre; Teléfono: :telefono; Rol: :rol",
            "login"                         => "Inició sesión correctamente. Teléfono: :telefono",
            "logout"                        => "Cerró sesión correctamente. Teléfono: :telefono",
            "intento_fallido"               => "Se intentó iniciar sesión con el teléfono: :telefono, pero no tuvo éxito",
            "baja_usuario"                  => "Se dió de baja al usuario: Nombre: :nombre; Teléfono: :telefono; Rol: :rol",
        ],
        "productos" => [
            "editar_producto"               => "Cambió el producto :id; :nombre",
            "crear_producto"                => "Creó el producto :id; :nombre",
            "baja_producto"                 => "Se dió de baja al producto: :id; :nombre",
        ],
        "proveedores" => [
            "editar_proveedor"              => "Cambió el proveedor :id; :nombre",
            "crear_proveedor"               => "Creó el proveedor :id; :nombre",
            "baja_proveedor"                => "Se dió de baja al proveedor: :id; :nombre",
        ],
        "almacenes" => [
            "editar_almacen"              => "Cambió el almacén :id; :nombre",
            "crear_almacen"               => "Creó el almacén :id; :nombre",
            "baja_almacen"                => "Se dió de baja al almacén: :id; :nombre",
        ],
        "cajas" => [
            "editar_caja"                   => "Cambió la caja :id; Tienda: :almacen; Abierta :abierta"
        ],
        "clientes" => [
            "editar_cliente"              => "Cambió el cliente :id; :nombre; :telefono; :correo; :acumulado; :estatus",
            "crear_cliente"               => "Creó el cliente :id; :nombre; :telefono; :correo; :acumulado; :estatus",
            "baja_cliente"                => "Se dió de baja al cliente: :id; :nombre; :telefono; :correo; :acumulado; :estatus",
        ],
        "marcas" => [
            "editar_marca"              => "Cambió la marca :id; :nombre",
            "crear_marca"               => "Creó la marca :id; :nombre",
            "baja_marca"                => "Se dió de baja la marca: :id; :nombre",
        ],
    ]
];
