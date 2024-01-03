<?php

return [
    'attributes' => [
        //user validate
        'name' => 'Họ tên',
        'email' => 'Email',
        'phone' => 'Số điện thoại',
        'address' => 'Địa chỉ',
        'role_id' => 'Chức vụ',
        'password' => 'Mật khẩu',
        'gender' => 'Giới tính',
        'password_confirmation' => 'Xác nhận mật khẩu',
        'birthday' => 'Sinh nhật',
        //end user validate
    ],
    'messages' => [
        //user validate
        'unique' => ':attribute đã tồn tại.',
        'required' => ':attribute là trường bắt buộc, không được để trống.',
        'email' => ':attribute không hợp lệ',
        'max' => ':attribute không được quá :max ký tự',
        'min' => ':attribute không được ít hơn :min ký tự',
        'regex' => ':attribute không hợp lệ',
        'confirmed' => ':attribute không khớp',
        'password.confirmed' => 'Mật khẩu và xác nhận mật khẩu không giống nhau.',
        //end user validate
    ],
];
