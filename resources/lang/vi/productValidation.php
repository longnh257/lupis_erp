<?php

return [
    'attributes' => [
        //user validate
        'name' => 'Tên sản phẩm',
        'quantity' => 'Số lượng',
        'price' => 'Giá',
        'cost' => 'Giá gốc',
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
