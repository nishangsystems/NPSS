<?php

return [
    'USER_STATUS' => ['active','suspended','unconfirmed'],
    'GENDER' => ['male','female'],
    'FEE_TYPE' => ['PTA','FEE'],
    'TERM' => ['First Term','Second Term','Third Term'],
    'SEQUENCE' => [
                    ['t_id' => '1','name' => '1st Sequence'],
                    ['t_id' => '1','name' => '2st Sequence'],
                    ['t_id' => '2','name' => '3st Sequence'],
                    ['t_id' => '2','name' => '4st Sequence'],
                    ['t_id' => '3','name' => '5st Sequence'],
                    ['t_id' => '3','name' => '6st Sequence'],
                ],

    'PERMISSION_GROUPS' => [
                              ['id' => '1','name' => 'Student'],
                              ['id' => '2','name' => 'User'],
                              ['id' => '3','name' => 'Subject'],
                              ['id' => '4','name' => 'Class'],
                              ['id' => '5','name' => 'Fee'],
                              ['id' => '6','name' => 'Roles']
                           ],
    'COMMON_PERMISSION' => ['Select','Create','Update','Delete','Suspend','Activate'],
    'ROLES' => ['Admin','Teacher','Parent','HM'],
];
