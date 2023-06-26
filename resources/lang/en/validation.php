<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | El campo following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'El campo :attribute debe ser aceptado.',
    'active_url' => 'El campo :attribute no es un URL válido.',
    'after' => 'El campo :attribute debe ser una fecha después de :date.',
    'after_or_equal' => 'El campo :attribute debe ser una fecha igual o mayor a :date.',
    'alpha' => 'El campo :attribute sólo puede contener letras.',
    'alpha_dash' => 'El campo :attribute solo puede contener letras, números, guiones y guiones bajos.',
    'alpha_num' => 'El campo :attribute solo puede contener letras y números.',
    'array' => 'El campo :attribute debe ser un array.',
    'before' => 'El campo :attribute debe ser una fecha anterior a :date.',
    'before_or_equal' => 'El campo :attribute debe ser una fecha anterior o igual a :date.',
    'between' => [
        'numeric' => 'El campo :attribute debe estar comprendido entre :min y :max.',
        'file' => 'El campo :attribute debe pesar entre :min y :max kilobytes.',
        'string' => 'El campo :attribute debe tener entre :min y :max caracteres.',
        'array' => 'El campo :attribute debe tener entre :min y :max items.',
    ],
    'boolean' => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed' => 'El campo :attribute no corresponde.',
    'date' => 'El campo :attribute no es una fecha válida.',
    'date_equals' => 'El campo :attribute debe ser igual a :date.',
    'date_format' => 'El campo :attribute no cumple con el formato :format.',
    'different' => 'El campo :attribute y :other deben ser diferentes.',
    'digits' => 'El campo :attribute debe contener :digits dígitos.',
    'digits_between' => 'El campo :attribute debe tener entre :min y :max dígitos.',
    'dimensions' => 'El campo :attribute tiene dimensiones de imagen no válidos.',
    'distinct' => 'El campo :attribute tiene valores duplicados.',
    'email' => 'El campo :attribute debe ser un correo electrónico válido.',
    'ends_with' => 'El campo :attribute debe terminar en: :values.',
    'exists' => 'El campo seleccionado :attribute no es válido.',
    'file' => 'El campo :attribute debe ser un archivo.',
    'filled' => 'El campo :attribute debe tener un valor.',
    'gt' => [
        'numeric' => 'El campo :attribute debe ser mayor a :value.',
        'file' => 'El campo :attribute debe tener más de :value kilobytes.',
        'string' => 'El campo :attribute debe tener más de :value caracteres.',
        'array' => 'El campo :attribute debe tener más de :value items.',
    ],
    'gte' => [
        'numeric' => 'El campo :attribute debe ser mayor o igual a :value.',
        'file' => 'El campo :attribute debe tener un tamaño mayor o igual a :value kilobytes.',
        'string' => 'El campo :attribute debe tener más o exactamente :value caracteres.',
        'array' => 'El campo :attribute debe tener más o exactamente :value items.',
    ],
    'image' => 'El campo :attribute debe ser una imagen.',
    'in' => 'El campo seleccionado :attribute no es válido.',
    'in_array' => 'El campo :attribute no existe en :other.',
    'integer' => 'El campo :attribute debe ser un número entero.',
    'ip' => 'El campo :attribute debe ser una dirección IP válida.',
    'ipv4' => 'El campo :attribute debe ser una dirección IPv4 válida.',
    'ipv6' => 'El campo :attribute debe ser una dirección IPv6 válida.',
    'json' => 'El campo :attribute debe ser un JSON válido.',
    'lt' => [
        'numeric' => 'El campo :attribute debe ser menor a :value.',
        'file' => 'El campo :attribute debe tener un tamaño menor a :value kilobytes.',
        'string' => 'El campo :attribute debe tener una longitud menor a :value caracteres.',
        'array' => 'El campo :attribute debe tener menos de :value items.',
    ],
    'lte' => [
        'numeric' => 'El campo :attribute debe ser menor o igual a :value.',
        'file' => 'El campo :attribute debe tener un tamaño menor o igual a :value kilobytes.',
        'string' => 'El campo :attribute debe tener una longitud menor o igual a :value caracteres.',
        'array' => 'El campo :attribute no debe tener más de :value items.',
    ],
    'max' => [
        'numeric' => 'El campo :attribute no debe ser mayor a :max.',
        'file' => 'El campo :attribute no debe tener un tamaño mayor a :max kilobytes.',
        'string' => 'El campo :attribute no debe tener una longitud mayor a :max caracteres.',
        'array' => 'El campo :attribute no debe tener más de :max items.',
    ],
    'mimes' => 'El campo :attribute debe ser un archivo de tipo: :values.',
    'mimetypes' => 'El campo :attribute debe ser un archivo de tipo: :values.',
    'min' => [
        'numeric' => 'El campo :attribute debe ser al menos :min.',
        'file' => 'El campo :attribute debe pesar al menos :min kilobytes.',
        'string' => 'El campo :attribute debe contener al menos :min caracteres.',
        'array' => 'El campo :attribute debe contener al menos :min items.',
    ],
    'multiple_of' => 'El campo :attribute debe ser múltiplo de :value.',
    'not_in' => 'El campo seleccionado :attribute no es válido.',
    'not_regex' => 'El campo :attribute format no es válido.',
    'numeric' => 'El campo :attribute debe ser un número.',
    'password' => 'El campo password es incorrecto.',
    'present' => 'El campo :attribute field debe estar presente.',
    'regex' => 'El campo :attribute tiene un formato inválido.',
    'required' => 'El campo :attribute es obligatorio.',
    'required_if' => 'El campo :attribute es obligatorio cuando :other es :value.',
    'required_unless' => 'El campo :attribute es obligatorio a menos que :other se encuentre en :values.',
    'required_with' => 'El campo :attribute es obligatorio cuando :values está(n) presente(s).',
    'required_with_all' => 'El campo :attribute es obligatorio cuando :values está(n) presente(s).',
    'required_without' => 'El campo :attribute es obligatorio cuando :values no está(n) presente(s).',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de el(los) valor(es): :values está(n) presente(s).',
    'same' => 'El campo :attribute y :other deben coincidir.',
    'size' => [
        'numeric' => 'El campo :attribute debe tener un tamaño de :size.',
        'file' => 'El campo :attribute debe tener un tamaño de :size kilobytes.',
        'string' => 'El campo :attribute debe tener un tamaño de :size caracteres.',
        'array' => 'El campo :attribute debe tener un tamaño de :size items.',
    ],
    'starts_with' => 'El campo :attribute debe iniciar con alguno de los siguientes valores: :values.',
    'string' => 'El campo :attribute debe ser texto.',
    'timezone' => 'El campo :attribute debe ser una zona horaria válida.',
    'unique' => 'Este valor ya está ocupado. Ingresa otro diferente.',
    'uploaded' => 'El campo :attribute falló al subirse.',
    'url' => 'El campo :attribute tiene un formato inválido.',
    'uuid' => 'El campo :attribute debe ser un UUID correcto.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | El campo following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
