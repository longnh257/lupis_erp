<?php

return [
    'attributes' => [
        //user validate
        'name' => 'Tên vật liệu',
        'quantity' => 'Số lượng',
        //end user validate
    ],
    'messages' => [
        //user validate
        'unique' => ':attribute đã tồn tại.',
        'required' => ':attribute là trường bắt buộc, không được để trống.',
        'max' => ':attribute không được quá :max ký tự',
        'min' => ':attribute không được ít hơn :min ký tự',
        'regex' => ':attribute không hợp lệ',
        'confirmed' => ':attribute không khớp',
        'password.confirmed' => 'Mật khẩu và xác nhận mật khẩu không giống nhau.',
        //end user validate
    ],
];
