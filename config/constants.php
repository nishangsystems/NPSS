<?php

return [
    'USER_STATUS' => ['active','suspended','unconfirmed'],
    'GENDER' => ['male','female'],
    'FEE_TYPE' => ['PTA','FEE'],
    'TERM' => ['First Term','Second Term','Third Term'],
    'SECTION' => ['Nursery','Primary'],
    'CLASS' => ['Nursery 1','Nursery 2','Nursery 3','Class 1','Class 2','Class 3','Class 4','Class 5','Class 6'],
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
                              ['id' => '6','name' => 'Roles'],
                              ['id' => '7','name' => 'Result']
                           ],

    'COMMON_PERMISSION' => ['See','Create','Update','Delete','Suspend','Activate'],
    'ROLES' => ['Admin','Teacher','Parent','HM'],
    'EXPENSE_STATUS' => ['paid','pending','due'],
    'SUBJECT_TYPE' => ['science','arts','commercial'],
    'PAYMENT_METHOD' => ['CASH','MTN MOMO','ORANGE MONEY','BANK'],
    'YEAR'=>['2016/2017','2017/2018','2018/2019','2019/2020'],

];
