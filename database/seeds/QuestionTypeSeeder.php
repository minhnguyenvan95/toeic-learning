<?php

use Illuminate\Database\Seeder;
use App\QuestionType;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        QuestionType::create(['id' => '1', 'name' => 'Hình Ảnh', 'meta' => 'Listening: Tương ứng với mỗi bức ảnh, bạn sẽ được nghe 04 câu mô tả về nó. Nhiệm vụ của bạn là phải chọn câu mô tả đúng nhất cho bức ảnh.']);
        QuestionType::create(['id' => '2', 'name' => 'Hỏi Đáp', 'meta' => 'Listening: Bạn sẽ nghe một câu hỏi (hoặc câu nói) và 03 lựa chọn trả lời. Nhiệm vụ của bạn là phải chọn ra câu trả lời đúng nhất trong ba đáp án A-B-C.']);
        QuestionType::create(['id' => '3', 'name' => 'Hội thoại ngắn', 'meta' => 'Listening: Bạn sẽ nghe 10 đoạn hội thoại ngắn. Mỗi đoạn có 03 câu hỏi. Nhiệm vụ của bạn là chọn ra câu trả lời đúng nhất trong 04 đáp án của đề thi.']);
        QuestionType::create(['id' => '4', 'name' => 'Đoạn thông tin ngắn', 'meta' => 'Listening: Bạn sẽ nghe 10 đoạn thông tin ngắn. Mỗi đoạn có 03 câu hỏi. Nhiệm vụ của bạn là chọn ra câu trả lời đúng nhất trong số 04 đáp án được cung cấp.']);
        QuestionType::create(['id' => '5', 'name' => 'Hoàn thành câu', 'meta' => 'Reading: Bạn cần phải chọn từ đúng nhất để hoàn thành câu.']);
        QuestionType::create(['id' => '6', 'name' => 'Điền vào đoạn văn', 'meta' => 'Reading: Mỗi đoạn văn có 03 chỗ trống. Bạn phải điền từ thích hợp còn thiếu vào mỗi chỗ trống trong đoạn văn đó.']);
        QuestionType::create(['id' => '7', 'name' => 'Đoạn văn', 'meta' => 'Reading: Đề thi có thể có từ 7-10 đoạn văn đơn. Hết mỗi đoạn văn sẽ có 2-5 câu hỏi hoặc sẽ có từ 04 cặp đoạn văn. Hết mỗi cặp đoạn văn sẽ có 5 câu hỏi.']);
    }
}
