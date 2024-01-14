<?php

return [
    'attributes' => [
        //user validate
        'assigned_to' => 'Nhân viên',
        'event_date' => 'Ngày đăng ký',
        'event_type' => 'Loại',
        'shift' => 'Ca',
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
        //end user validate
    ],
];
