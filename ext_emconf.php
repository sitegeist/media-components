<?php
$EM_CONF['media_components'] = [
    'title' => 'Media Components',
    'description' => 'Ready-to-use fluid components for embedding different media files',
    'category' => 'fe',
    'author' => 'Benjamin Tammling, Ulrich Mathes, Simon Praetorius',
    'author_email' => 'benjamin.tammling@sitegeist.de, mathes@sitegeist.de, moin@praetorius.me',
    'author_company' => 'sitegeist media solutions GmbH',
    'state' => 'stable',
    'uploadfolder' => false,
    'clearCacheOnLoad' => false,
    'version' => '1.0.0-dev',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.0-11.9.99',
            'php' => '7.2.0-7.9.99'
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
