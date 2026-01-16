<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. TẠO USER (NGƯỜI DÙNG)
        // Tạo Admin
        $adminId = DB::table('users')->insertGetId([
            'name' => 'Admin Đẹp Trai',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'), // Mật khẩu: 123456
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tạo Member thường
        $memberId = DB::table('users')->insertGetId([
            'name' => 'Thành Viên Vui Tính',
            'email' => 'member@gmail.com',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. TẠO CATEGORY (DANH MỤC)
        $cat1 = DB::table('categories')->insertGetId(['name' => 'Tin Tức', 'slug' => 'tin-tuc', 'created_at' => now(), 'updated_at' => now()]);
        $cat2 = DB::table('categories')->insertGetId(['name' => 'Lập Trình Laravel', 'slug' => 'lap-trinh-laravel', 'created_at' => now(), 'updated_at' => now()]);
        $cat3 = DB::table('categories')->insertGetId(['name' => 'Chuyện Đời', 'slug' => 'chuyen-doi', 'created_at' => now(), 'updated_at' => now()]);

        // 3. TẠO POST (BÀI VIẾT)
        // Bài 1: Admin đăng
        $post1 = DB::table('posts')->insertGetId([
            'title' => 'Chào mừng đến với Blog Laravel',
            'slug' => 'chao-mung-den-voi-blog-laravel',
            'description' => 'Bài viết giới thiệu về khóa học Laravel cơ bản.',
            'content' => "Xin chào các bạn!\n\nĐây là bài viết đầu tiên trên hệ thống Blog của chúng ta. Chúc các bạn học tập tốt!",
            'category_id' => $cat2, // Chuyên mục Lập Trình
            'user_id' => $adminId,  // Admin đăng
            'is_published' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Bài 2: Member đăng
        $post2 = DB::table('posts')->insertGetId([
            'title' => 'Hôm nay trời đẹp quá',
            'slug' => 'hom-nay-troi-dep-qua',
            'description' => 'Một chút cảm xúc vu vơ ngày cuối tuần.',
            'content' => "Sáng nay thức dậy thấy trời xanh ngắt, quyết định ngồi code Laravel cho nó chill.\n\nCó ai giống mình không?",
            'category_id' => $cat3, // Chuyên mục Chuyện Đời
            'user_id' => $memberId, // Member đăng
            'is_published' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4. TẠO COMMENT (BÌNH LUẬN)
        // Comment của Member vào bài 1
        DB::table('comments')->insert([
            'post_id' => $post1,
            'user_id' => $memberId,
            'session_id' => null,
            'guest_name' => null,
            'content' => 'Bài viết hay quá admin ơi! Hóng bài tiếp theo.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Comment của KHÁCH vào bài 1
        DB::table('comments')->insert([
            'post_id' => $post1,
            'user_id' => null, // Không có user_id
            'session_id' => Str::random(40), // Giả lập session ID
            'guest_name' => 'Người Qua Đường',
            'content' => 'Mình là khách vãng lai, mình thấy trang web này rất đẹp.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Comment của Admin trả lời Member ở bài 1
        DB::table('comments')->insert([
            'post_id' => $post1,
            'user_id' => $adminId,
            'session_id' => null,
            'guest_name' => null,
            'content' => 'Cảm ơn bạn nhé! Sẽ có bài mới sớm thôi.',
            'created_at' => now()->addMinutes(5), // Comment sau 5 phút
            'updated_at' => now()->addMinutes(5),
        ]);
    }
}