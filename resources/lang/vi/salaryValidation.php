<?php

return [
    'attributes' => [
        //user validate
        'month' => 'Tháng',
        'payday' => 'Ngày thanh toán',
        'quantity' => 'Số lượng',
        //end user validate
    ],
    'messages' => [
        //user validate
        'unique' => ':attribute đã tồn tại.',
        'month.required' => 'Hãy chọn một tháng để tính lương!',
        'required' => ':attribute là trường bắt buộc, không được để trống.',
        'max' => ':attribute không được quá :max ký tự',
        'min' => ':attribute không được ít hơn :min ký tự',
        'confirmed' => ':attribute không khớp',
        'numeric' => ':attribute phải là số',
        //end user validate
    ],
];
