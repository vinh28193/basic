<?php
return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        '<controller:[\w-]+>'                                 => '<controller>/index',
        '<controller:[\w-]+>/<action:[\w-]+>'                 => '<controller>/<action>',
        '<module:[\w-]+>/<controller:[\w-]+>'                 => '<module>/<controller>/index',
        '<module:[\w-]+>/<controller:[\w-]+>/<action:[\w-]+>' => '<module>/<controller>/<action>',
    ],
];
?>