<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'      => 'required|string|max:100',
            'category'   => ['required', Rule::in(array_keys(Post::CATEGORIES))],
            'content'    => 'required|string|min:20',
            'image_file' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', // tối đa 2MB
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'      => 'Vui lòng nhập tiêu đề.',
            'title.max'           => 'Tiêu đề tối đa 100 ký tự.',
            'category.required'   => 'Vui lòng chọn chuyên mục.',
            'category.in'         => 'Chuyên mục không hợp lệ.',
            'content.required'    => 'Vui lòng nhập nội dung.',
            'content.min'         => 'Nội dung tối thiểu 20 ký tự.',
            'image_file.required' => 'Vui lòng chọn ảnh cho bài viết.',
            'image_file.image'    => 'File tải lên phải là hình ảnh.',
            'image_file.mimes'    => 'Ảnh chỉ chấp nhận định dạng jpg, jpeg, png, webp.',
            'image_file.max'      => 'Dung lượng ảnh tối đa 2MB.',
            'image_file.uploaded' => 'Tải ảnh lên thất bại, ảnh có thể quá lớn.',
        ];
    }
}
