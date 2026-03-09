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
                ['value' => 'perro',       'label' => 'Perro',     'image' => '/images/examples/perro_dibu.png', 'pro' => false, 'popular' => true, 'combos' => 'cartoon, pixar, watercolor'],
                ['value' => 'gato',        'label' => 'Gato',      'image' => '/images/examples/gato_dibu.png', 'pro' => false, 'popular' => true, 'combos' => 'cartoon, pixar, watercolor'],
                ['value' => 'robot',       'label' => 'Robot', 'image' => '/images/examples/robot_dibu.png', 'pro' => false, 'popular' => true, 'combos' => 'cartoon, pixar, watercolor'],
                ['value' => 'persona',     'label' => 'Persona', 'image' => '/images/examples/persona_dibu.png', 'pro' => false, 'popular' => false ,'combos' => 'realistic, portrait, fashion'],
                ['value' => 'unicornio',   'label' => 'Unicornio', 'image' => '/images/examples/unicornio_dibu.png', 'pro' => false, 'popular' => false, 'combos' => 'fantasy, magical'],
                ['value' => 'dragon',      'label' => 'Dragon', 'image' => '/images/examples/dragon_dibu.png', 'pro' => false, 'popular' => false, 'combos' => 'fantasy, medieval'],
                ['value' => 'astronauta',  'label' => 'Astronauta', 'image' => '/images/examples/astronauta-dibujo.png', 'pro' => false, 'popular' => false, 'combos' => 'sci-fi, space'],
                ['value' => 'hada',        'label' => 'Hada', 'image' => '/images/examples/hada-dibujo.png', 'pro' => false, 'popular' => false, 'combos' => 'fantasy, magical'],
                ['value' => 'sirena',      'label' => 'Sirena', 'image' => '/images/examples/sirena-dibujo.png', 'pro' => false, 'popular' => false, 'combos' => 'fantasy, aquatic'],
                ['value' => 'pajaro',      'label' => 'Pajaro', 'image' => '/images/examples/pajaro-dibujo.png', 'pro' => false, 'popular' => false, 'combos' => 'fantasy, aquatic'],
                ['value' => 'oso',         'label' => 'Oso', 'image' => '/images/examples/oso-dibujo.jpg', 'pro' => false, 'popular' => false, 'combos' => 'nature, wildlife'],
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

