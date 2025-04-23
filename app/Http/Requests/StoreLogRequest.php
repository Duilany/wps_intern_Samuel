<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Izinkan hanya staf yang sudah login untuk membuat/memperbarui log
        return Auth::check() && in_array(Auth::user()->role, ['staff_operasional', 'staff_keuangan']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tanggal' => 'required|date|date_format:Y-m-d',
            'isi_log' => 'required|string',
            'bukti' => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:2048',
        ];
    }

    /**
     * Get custom error messages for validation.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Tanggal tidak valid.',
            'tanggal.date_format' => 'Format tanggal harus YYYY-MM-DD.',
            'isi_log.required' => 'Isi log wajib diisi.',
            'isi_log.string' => 'Isi log harus berupa teks.',
            'bukti.file' => 'Bukti harus berupa file.',
            'bukti.mimes' => 'Bukti harus berupa file dengan format JPG, PNG, PDF, DOC, atau DOCX.',
            'bukti.max' => 'Ukuran file bukti maksimal 2MB.',
        ];
    }
}