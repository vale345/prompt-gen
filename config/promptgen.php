<?php

/**
 * Prompt generator field definitions.
 * Each field has a key, label, description, badge, and a list of options.
 */
return [
    'fields' => [
        'personaje' => [
            'label'       => 'Personaje',
            'description' => 'Elegi el sujeto principal de la imagen',
            'badge'       => 'Requerido',
            'required'    => true,
            'options'     => [
                ['value' => 'perro',       'label' => 'Perro'],
                ['value' => 'gato',        'label' => 'Gato'],
                ['value' => 'robot',       'label' => 'Robot'],
                ['value' => 'persona',     'label' => 'Persona'],
                ['value' => 'unicornio',   'label' => 'Unicornio'],
                ['value' => 'dragon',      'label' => 'Dragon'],
                ['value' => 'astronauta',  'label' => 'Astronauta'],
                ['value' => 'hada',        'label' => 'Hada'],
                ['value' => 'dinosaurio',  'label' => 'Dinosaurio'],
                ['value' => 'sirena',      'label' => 'Sirena'],
                ['value' => 'pajaro',      'label' => 'Pajaro'],
                ['value' => 'oso',         'label' => 'Oso'],
            ],
        ],

        'estilo' => [
            'label'       => 'Estilo visual',
            'description' => 'Deja vacio para que la IA lo interprete',
            'badge'       => 'Opcional',
            'required'    => false,
            'options'     => [
                ['value' => 'crochet',       'label' => 'Crochet'],
                ['value' => 'acuarela',      'label' => 'Acuarela'],
                ['value' => 'cartoon',       'label' => 'Cartoon'],
                ['value' => 'realista',      'label' => 'Realista'],
                ['value' => 'pixel-art',     'label' => 'Pixel Art'],
                ['value' => 'minimalista',   'label' => 'Minimalista'],
                ['value' => 'oleo',          'label' => 'Oleo'],
                ['value' => 'neon',          'label' => 'Neon'],
                ['value' => 'vintage',       'label' => 'Vintage'],
                ['value' => 'kawaii',        'label' => 'Kawaii'],
                ['value' => 'pop-art',       'label' => 'Pop Art'],
                ['value' => 'flat-design',   'label' => 'Flat Design'],
            ],
        ],

        'ambiente' => [
            'label'       => 'Ambiente / Fondo',
            'description' => 'Donde se ubica la escena',
            'badge'       => 'Opcional',
            'required'    => false,
            'options'     => [
                ['value' => 'bosque',         'label' => 'Bosque'],
                ['value' => 'playa',          'label' => 'Playa'],
                ['value' => 'ciudad',         'label' => 'Ciudad'],
                ['value' => 'espacio',        'label' => 'Espacio'],
                ['value' => 'montanas',       'label' => 'Montanas'],
                ['value' => 'desierto',       'label' => 'Desierto'],
                ['value' => 'jardin',         'label' => 'Jardin'],
                ['value' => 'fondo-blanco',   'label' => 'Fondo blanco'],
                ['value' => 'fondo-pastel',   'label' => 'Fondo pastel'],
                ['value' => 'estudio',        'label' => 'Estudio'],
                ['value' => 'cafe',           'label' => 'Cafe'],
                ['value' => 'bajo-el-agua',   'label' => 'Bajo el agua'],
            ],
        ],

        'uso' => [
            'label'       => 'Uso comercial',
            'description' => 'Para que vas a usar la imagen?',
            'badge'       => 'Recomendado',
            'required'    => false,
            'options'     => [
                ['value' => 'redes-sociales',  'label' => 'Redes sociales'],
                ['value' => 'print-on-demand', 'label' => 'Print on Demand'],
                ['value' => 'stickers',        'label' => 'Stickers / Calcos'],
                ['value' => 'ebook-cover',     'label' => 'Portada de ebook'],
                ['value' => 'merchandising',   'label' => 'Merchandising'],
                ['value' => 'stock-photos',    'label' => 'Stock photos'],
                ['value' => 'presentaciones',  'label' => 'Presentaciones'],
                ['value' => 'web-banners',     'label' => 'Banners web'],
            ],
        ],

        'extras' => [
            'label'       => 'Extras',
            'description' => 'Iluminacion, emocion, angulo de camara o nivel de detalle',
            'badge'       => 'Avanzado',
            'required'    => false,
            'options'     => [
                ['value' => 'luz-suave',       'label' => 'Luz suave'],
                ['value' => 'luz-dramatica',   'label' => 'Luz dramatica'],
                ['value' => 'contraluz',       'label' => 'Contraluz'],
                ['value' => 'expresion-feliz', 'label' => 'Expresion feliz'],
                ['value' => 'expresion-seria', 'label' => 'Expresion seria'],
                ['value' => 'primer-plano',    'label' => 'Primer plano'],
                ['value' => 'plano-general',   'label' => 'Plano general'],
                ['value' => 'alto-detalle',    'label' => 'Alto detalle'],
                ['value' => 'bokeh',           'label' => 'Bokeh'],
                ['value' => 'cenital',         'label' => 'Vista cenital'],
            ],
        ],
    ],
];
