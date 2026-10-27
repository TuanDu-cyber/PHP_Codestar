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
            // Du lịch
            [
                'category' => 'travel',
                'title'    => 'Hoàng hôn bên dòng sông, ngắm cầu lên đèn',
                'image'    => 'images/world5.jpg',
                'content'  => "Chiều cuối tuần, mình ra bờ sông ngồi chờ hoàng hôn. Khi ánh nắng cuối ngày tắt dần, những ngọn đèn trên cầu bắt đầu sáng lên rất đẹp.\n\nChuyến đi nhỏ nhưng đủ để mình thấy nhẹ nhõm sau một tuần học tập căng thẳng.",
            ],
            [
                'category' => 'travel',
                'title'    => 'Một ngày dạo quanh London bên dòng sông Thames',
                'image'    => 'images/world2.jpg',
                'content'  => "Đứng bên bờ sông Thames nhìn tháp đồng hồ và tòa nhà Quốc hội, mình mới thấy ảnh trên mạng vẫn chưa đủ đẹp.\n\nMình ghi lại vài địa điểm nên ghé qua và những điều rút ra sau chuyến đi.",
            ],
            [
                'category' => 'travel',
                'title'    => 'Thành phố về đêm bên cầu Brooklyn',
                'image'    => 'images/world10.jpg',
                'content'  => "Ánh đèn thành phố phản chiếu trên mặt nước tạo nên khung cảnh rất khó quên. Mình đứng khá lâu để chụp được bức ảnh này.\n\nNếu có dịp, bạn nên ghé vào buổi tối để cảm nhận không khí khác hẳn ban ngày.",
            ],

            // Học tập
            [
                'category' => 'study',
                'title'    => 'Những dòng code Blade đầu tiên của mình',
                'image'    => 'images/business4.jpg',
                'content'  => "Hôm nay mình bắt đầu học Blade trong Laravel. Cảm giác đầu tiên là khá dễ chịu vì cú pháp ngắn gọn, dễ đọc.\n\nCác directive như extends, section, yield giúp mình tách layout rất gọn, không phải sao chép header và footer nhiều lần.",
            ],
            [
                'category' => 'study',
                'title'    => 'Góc học tập nhỏ gọn của mình',
                'image'    => 'images/business7.jpg',
                'content'  => "Mình thích một góc bàn gọn gàng với máy tính, vài chậu cây nhỏ và ánh sáng tự nhiên.\n\nKhông gian sạch sẽ giúp mình tập trung học lâu hơn mỗi ngày.",
            ],
            [
                'category' => 'study',
                'title'    => 'Buổi học nhóm cuối tuần cùng lớp',
                'image'    => 'images/business1.jpg',
                'content'  => "Cuối tuần cả nhóm tụ tập để làm bài tập chung. Mỗi người một việc, vừa làm vừa trao đổi nên tiến độ nhanh hơn hẳn.\n\nMình học được nhiều mẹo hay từ các bạn.",
            ],
            [
                'category' => 'study',
                'title'    => 'Thói quen đọc tin mỗi sáng',
                'image'    => 'images/politics5.jpg',
                'content'  => "Mỗi sáng mình dành mười lăm phút để đọc tin tức. Thói quen nhỏ này giúp mình mở rộng hiểu biết và có thêm nhiều chủ đề để viết blog.\n\nBạn cũng có thể thử xem sao.",
            ],

            // Thể thao
            [
                'category' => 'sport',
                'title'    => 'Chạy bộ buổi sáng bên hồ',
                'image'    => 'images/sport2.jpg',
                'content'  => "Sáng sớm không khí trong lành, đường vắng nên chạy rất thoải mái. Mình đặt mục tiêu chạy đều đặn vài buổi mỗi tuần.\n\nSau mỗi buổi chạy, đầu óc mình minh mẫn hơn hẳn.",
            ],
            [
                'category' => 'sport',
                'title'    => 'Đá bóng cuối tuần cùng bạn bè',
                'image'    => 'images/sport5.jpg',
                'content'  => "Không cần giỏi, chỉ cần vui là đủ. Trận bóng cuối tuần là cách mình xả stress sau những ngày học tập.\n\nCả nhóm hẹn nhau đều đặn mỗi tuần.",
            ],
            [
                'category' => 'sport',
                'title'    => 'Lần đầu xem bóng bầu dục',
                'image'    => 'images/sport6.jpg',
                'content'  => "Luật chơi khá phức tạp nhưng không khí trận đấu rất cuốn hút. Mình vừa xem vừa tra cứu luật chơi.\n\nHy vọng sẽ có dịp xem trực tiếp ở sân vận động.",
            ],
            [
                'category' => 'sport',
                'title'    => 'Ngắm siêu xe ở trường đua',
                'image'    => 'images/sport7.jpg',
                'content'  => "Tiếng động cơ và những đường nét của chiếc xe thể thao khiến mình mê mẩn. Mình chụp vài bức ảnh làm kỷ niệm.\n\nĐây là lần đầu mình đến gần một chiếc siêu xe như vậy.",
            ],

            // Đời sống
            [
                'category' => 'life',
                'title'    => 'Đêm nhạc sống đáng nhớ',
                'image'    => 'images/entertainment1.jpg',
                'content'  => "Hàng nghìn người cùng hát vang dưới ánh đèn sân khấu, cảm giác thật khó tả.\n\nMình sẽ còn đi thêm nhiều đêm nhạc như vậy.",
            ],
            [
                'category' => 'life',
                'title'    => 'Học đàn guitar cùng bạn',
                'image'    => 'images/entertainment4.jpg',
                'content'  => "Mình và bạn hẹn nhau tập guitar mỗi cuối tuần. Ban đầu ngón tay đau và bấm hợp âm còn vụng.\n\nNhưng luyện đều mỗi ngày, mình đã chơi được vài bài đơn giản.",
            ],
            [
                'category' => 'life',
                'title'    => 'Đám cưới của người bạn thân',
                'image'    => 'images/entertainment6.jpg',
                'content'  => "Hôm nay mình đi dự đám cưới của người bạn thân. Nhìn bó hoa cưới trong tay cô dâu, mình thấy rất xúc động và vui cho bạn.\n\nChúc hai bạn hạnh phúc.",
            ],
            [
                'category' => 'life',
                'title'    => 'Chân dung bạn mình qua ống kính',
                'image'    => 'images/entertainment10.jpg',
                'content'  => "Mình thử chụp chân dung bằng ánh sáng ngược. Bức ảnh khá tự nhiên và có chiều sâu.\n\nMình đang học thêm về ánh sáng và bố cục.",
            ],
        ];

        foreach ($data as $i => $item) {
            Post::create($item + ['published_at' => now()->subDays($i)]);
        }
    }
    
}
