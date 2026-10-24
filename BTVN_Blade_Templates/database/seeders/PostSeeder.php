<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $data = [
            // World (3 bài)
            ['World', 'Hàng nghìn người xuống đường biểu tình ở thủ đô', 'images/politics2.jpg'],
            ['World', 'Lực lượng chức năng tăng cường an ninh tại trung tâm thành phố', 'images/politics10.jpg'],
            ['World', 'Toàn cảnh thành phố nhìn từ trên cao sau trận mưa lớn', 'images/world9.jpg'],

            // Politics (4 bài)
            ['Politics', 'Quốc hội thảo luận dự thảo luật mới về giáo dục', 'images/politics4.jpg'],
            ['Politics', 'Báo chí đưa tin sôi động sau cuộc họp thượng đỉnh', 'images/politics5.jpg'],
            ['Politics', 'Cảnh sát siết chặt giao thông trong dịp lễ lớn', 'images/politics9.jpg'],
            ['Politics', 'Thủ đô London đón đoàn đại biểu quốc tế', 'images/world2.jpg'],

            // Business (4 bài)
            ['Business', 'Doanh nghiệp vừa và nhỏ đẩy mạnh chuyển đổi số', 'images/business1.jpg'],
            ['Business', 'Thị trường công nghệ tăng trưởng mạnh quý này', 'images/business4.jpg'],
            ['Business', 'Chỉ số kinh tế tháng 10 vượt dự báo của giới phân tích', 'images/business7.jpg'],
            ['Business', 'Cảng container đạt công suất kỷ lục', 'images/business10.jpg'],

            // Sport (4 bài)
            ['Sport', 'Vận động viên marathon phá kỷ lục cá nhân', 'images/sport2.jpg'],
            ['Sport', 'Sân vận động sẵn sàng cho trận chung kết cuối tuần', 'images/sport5.jpg'],
            ['Sport', 'Giải bóng bầu dục khởi tranh với nhiều bất ngờ', 'images/sport6.jpg'],
            ['Sport', 'Giải đua xe thể thao thu hút hàng chục nghìn khán giả', 'images/sport7.jpg'],

            // Entertainment (4 bài)
            ['Entertainment', 'Đêm nhạc sống bùng nổ trước hàng nghìn khán giả', 'images/entertainment1.jpg'],
            ['Entertainment', 'Nghệ sĩ guitar ra mắt album đầu tay', 'images/entertainment4.jpg'],
            ['Entertainment', 'Đám cưới của năm khiến mạng xã hội xôn xao', 'images/entertainment6.jpg'],
            ['Entertainment', 'Tuần lễ thời trang mở màn với nhiều thiết kế độc đáo', 'images/entertainment10.jpg'],
        ];

        foreach ($data as $i => [$category, $title, $image]) {
            Post::create([
                'title'        => $title,
                'category'     => $category,
                'image'        => $image,
                'published_at' => now()->subMinutes($i * 17),
            ]);
        }
    }
}
