<?php

return [
    'attributes' => [
        //user validate
        'assigned_to' => 'Nhân viên',
        //end user validate
    ],
    'messages' => [
        //user validate
        'unique' => ':attribute đã tồn tại.',
        'required' => ':attribute là trường bắt buộc, không được để trống.',
        'max' => ':attribute không được quá :max ký tự',
        'min' => ':attribute không được ít hơn :min ký tự',
        'confirmed' => ':attribute không khớp',
        'numeric' => ':attribute phải là số',
        'sell_quantity.*.numeric' => 'Số lượng đã bán phải là số',
        //end user validate
    ],
];
