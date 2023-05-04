<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ' :attribute phải được chấp nhận.',
    'accepted_if' => ':attribute phải được chấp nhận khi :other là :value.',
    'active_url' => ':attribute không phải URL hợp lệ.',
    'after' => ':attribute phải là một ngày sau ngày :date.',
    'after_or_equal' => ':attribute phải là một ngày sau hoặc bằng ngày :date.',
    'alpha' => ':attribute chỉ được chứa các chữ cái.',
    'alpha_dash' => ':attribute chỉ được chứa các chữ cái, số, dấu gạch ngang và dấu gạch dưới.',
    'alpha_num' => ':attribute chỉ được chứa các chữ cái và số.',
    'array' => ':attribute phải là mảng',
    'before' => ':attribute phải là 1 ngày trước ngày :date.',
    'before_or_equal' => ':attribute phải là một ngày trước hoặc bằng ngày :date.',
    'between' => [
        'array' => ':attribute phải có từ :min đến :max phần tử.',
        'file' => ':attribute phải có từ :min đến :max kilobytes.',
        'numeric' => ':attribute phải có từ :min đến :max.',
        'string' => ':attribute phải có từ :min đến :max kí tự.',
    ],
    'boolean' => 'Trường :attribute phải đúng hoặc sai.',
    'confirmed' => ':attribute xác nhận không hợp lệ.',
    'current_password' => 'Mật khẩu không đúng.',
    'date' => ':attribute không phải ngày hợp lệ.',
    'date_equals' => ':attribute phải là ngày :date.',
    'date_format' => ':attribute không phù hợp với định dạng :format.',
    'declined' => ':attribute bị từ chối.',
    'declined_if' => ':attribute bị từ chối khi :other là :value.',
    'different' => ':attribute và :other phải khác nhau.',
    'digits' => ':attribute phải là :digits chữ số.',
    'digits_between' => ':attribute phải có từ :min đến :max chữ số.',
    'dimensions' => ':attribute có kích thước ảnh không hợp lệ.',
    'distinct' => ':attribute có 1 giá trị trùng lặp.',
    'doesnt_start_with' => ':attribute có thể không bắt đầu với một trong những following: :values.',
    'email' => ':attribute là một địa chỉ email hợp lệ.',
    'ends_with' => ':attribute có thể kết thúc với một trong những following: :values.',
    'enum' => ':attribute đã chọn không hợp lệ.',
    'exists' => ':attribute đã chọn không hợp lệ.',
    'file' => ':attribute là một tập tin.',
    'filled' => 'Trường :attribute phải có giá trị.',
    'gt' => [
        'array' => ':attribute phải có nhiều hơn :value phần tử.',
        'file' => ':attribute phải lớn hơn :value kilobytes.',
        'numeric' => ':attribute phải lớn hơn :value.',
        'string' => ':attribute phải lớn hơn :value kí tự.',
    ],
    'gte' => [
        'array' => ':attribute phải có :value phần tử hoặc hơn.',
        'file' => ':attribute phải lớn hơn hoặc bằng :value kilobytes.',
        'numeric' => ':attribute phải lớn hơn hoặc bằng :value.',
        'string' => ':attribute phải lớn hơn hoặc bằng :value kí tự.',
    ],
    'image' => ':attribute là hình ảnh.',
    'in' => ':attribute đã chọn không hợp lệ.',
    'in_array' => ':attribute không tồn tại trong :other.',
    'integer' => ':attribute là số nguyên.',
    'ip' => ':attribute là một địa chỉ IP hợp lệ.',
    'ipv4' => ':attribute là một địa chỉ IPv4 hợp lệ.',
    'ipv6' => ':attribute là một địa chỉ IPv6 hợp lệ.',
    'json' => ':attribute là một chuỗi JSON hợp lệ.',
    'lt' => [
        'array' => ':attribute không được có ít hơn :value phần tử.',
        'file' => ':attribute phải nhỏ hơn :value kilobytes.',
        'numeric' => ':attribute phải nhỏ hơn :value.',
        'string' => ':attribute phải nhỏ hơn :value kí tự.',
    ],
    'lte' => [
        'array' => ':attribute must not have more than :value items.',
        'file' => ':attribute phải nhỏ hơn hoặc bằng :value kilobytes.',
        'numeric' => ':attribute phải nhỏ hơn hoặc bằng :value.',
        'string' => ':attribute phải nhỏ hơn hoặc bằng :value kí tự.',
    ],
    'mac_address' => ':attribute là một địa chỉ MAC hợp lệ.',
    'max' => [
        'array' => ':attribute không được có nhiều hơn :max phần tử.',
        'file' => ':attribute không được lớn hơn :max kilobytes.',
        'numeric' => ':attribute không được lớn hơn :max.',
        'string' => ':attribute không được lớn hơn :max kí tự.',
    ],
    'mimes' => ':attribute là một tập tin của type: :values.',
    'mimetypes' => ':attribute là một tập tin của type: :values.',
    'min' => [
        'array' => ':attribute phải có ít nhất :min phần tử.',
        'file' => ':attribute phải ít nhất :min kilobytes.',
        'numeric' => ':attribute phải ít nhất :min.',
        'string' => ':attribute phải ít nhất :min kí tự.',
    ],
    'multiple_of' => ':attribute phải là bội số của :value.',
    'not_in' => ':attribute đã chọn không hợp lệ.',
    'not_regex' => ':attribute định dạng không hợp lệ.',
    'numeric' => ':attribute phải là số.',
    'password' => [
        'letters' => ':attribute chứa ít nhất một chữ cái.',
        'mixed' => ':attribute phải chứa ít nhất một chữ hoa và một chữ thường.',
        'numbers' => ':attribute phải chứa ít nhất 1 số.',
        'symbols' => ':attribute phải chứa ít nhất 1 kí tự đặc biệt.',
        'uncompromised' => 'Đã cho :attribute đã có trong một vụi rò rỉ dữ liệu. Vui lòng chọn 1 :attribute khác.',
    ],
    'present' => 'Trường :attribute phải có.',
    'prohibited' => 'Trường :attribute bị cấm.',
    'prohibited_if' => 'Trường :attribute bị cấm khi :other là :value.',
    'prohibited_unless' => 'Trường :attribute bị cấm trừ khi :other nằm trong :values.',
    'prohibits' => 'Trường :attribute bị cấm khi :other có mặt.',
    'regex' => ':attribute định dạng không hợp lệ.',
    'required' => 'Trường :attribute là bắt buộc.',
    'required_array_keys' => 'Trường :attribute phải chứa các mục for: :values.',
    'required_if' => 'Trường :attribute là bắt buộc khi :other là :value.',
    'required_unless' => ':Trường attribute là bắt buộc trừ khi :other nằm trong :values.',
    'required_with' => ':Trường attribute là bắt buộc khi :values tồn tại.',
    'required_with_all' => ':Trường attribute là bắt buộc khi :values  tồn tại.',
    'required_without' => ':Trường attribute là bắt buộc khi :values không tồn tại.',
    'required_without_all' => ':Trường attribute là bắt buộc khi không có :values nào tồn tại.',
    'same' => ':attribute và :other phải trùng khớp.',
    'size' => [
        'array' => ':attribute phải chứa :size phần tử.',
        'file' => ':attribute phải là :size kilobytes.',
        'numeric' => ':attribute phải là :size.',
        'string' => ':attribute phải là :size kí tự.',
    ],
    'starts_with' => ':attribute phải bắt đầu bằng 1 trong những following: :values.',
    'string' => ':attribute phải là chuỗi.',
    'timezone' => ':attribute phải là múi giờ hợp lệ.',
    'unique' => ':attribute đã tồn tại.',
    'uploaded' => ':attribute không thể tải lên.',
    'url' => ':attribute phải là URL hợp lệ.',
    'uuid' => ':attribute phải là UUID hợp lệ.',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
