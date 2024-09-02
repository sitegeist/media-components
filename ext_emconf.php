<?php
$EM_CONF['media_components'] = [
    'title' => 'Media Components',
    'description' => 'Ready-to-use fluid components for embedding different media files',
    'category' => 'fe',
    'author' => 'Benjamin Tammling, Ulrich Mathes, Simon Praetorius',
    'author_email' => 'benjamin.tammling@sitegeist.de, mathes@sitegeist.de, moin@praetorius.me',
    'state' => 'stable',
    'version' => '',
    'constraints' => [
        'depends' => [
            'typo3' => '13.2.0-13.2.99',
            'php' => '8.2.0-8.3.99'
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Sitegeist\\MediaComponents\\' => 'Classes'
        ]
    ],
];
