<?php

return [
    'App\Entity\User' => [
        'user1' => [
            'email' => 'antoine.dumont@finelia.fr',
            'roles' => ['0' => 'user'],
            'password' => '@@$argon2id$v=19$m=65536,t=4,p=1$2upSUkl3Xb7h8llVcSYRPA$C0b+nLha6YCKCPclB2OGmkpwZLUNT2vBBchSnrINND4',
            'firstname' => 'Antoine',
            'lastname' => 'Dumont',
            'is_recruiter' => true
        ],
        'user2' => [
            'email' => 'dumont.antoine27@gmail.com',
            'roles' => ['0' => 'user'],
            'password' => '@@$argon2id$v=19$m=65536,t=4,p=1$2upSUkl3Xb7h8llVcSYRPA$C0b+nLha6YCKCPclB2OGmkpwZLUNT2vBBchSnrINND4',
            'firstname' => 'Ugo',
            'lastname' => 'Dumont',
            'is_recruiter' => false
        ],
    ],
];
