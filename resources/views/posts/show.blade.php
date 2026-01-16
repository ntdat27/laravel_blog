<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>{{ $post->title }}</title>
</head>

<body style="font-family: sans-serif; max-width: 800px; margin: 0 auto; padding: 20px;">

    <a href="/" style="text-decoration: none;">&larr; Quay lại trang chủ</a>

    <div style="margin-top: 20px; border-bottom: 1px solid #ccc; padding-bottom: 20px;">
        <h1>{{ $post->title }}</h1>
        <small style="color: gray;">Ngày đăng: {{ $post->created_at->format('d/m/Y') }}</small>

        <div style="margin-top: 20px; line-height: 1.6;">
            {!! nl2br(e($post->content)) !!}
        </div>
    </div>

    @if(session('success'))
        <p style="color: green; font-weight: bold; padding: 10px; border: 1px solid green;">
            {{ session('success') }}
        </p>
    @endif

    <div style="margin-top: 30px;">
        <h3>Bình luận ({{ $post->comments->count() }})</h3>

        <ul style="list-style: none; padding: 0;">
            @foreach($post->comments as $comment)
                <li style="margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                    <strong>
                        {{ $comment->user ? $comment->user->name : $comment->guest_name }}
                    </strong>

                    <span style="color: gray; font-size: 0.9em;">
                        - {{ $comment->created_at->diffForHumans() }}
                    </span>

                    <p style="margin: 5px 0;">{{ $comment->content }}</p>
                </li>
            @endforeach
        </ul>

        @if($post->comments->isEmpty())
            <p style="color: gray;">Chưa có bình luận nào.</p>
        @endif

        <div style="background: #f9f9f9; padding: 15px; margin-top: 20px;">
            <h4>Viết bình luận mới</h4>

            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                @csrf

                @guest
                    <div style="margin-bottom: 10px;">
                        <label>Tên của bạn:</label><br>
                        <input type="text" name="guest_name" placeholder="Nhập tên hiển thị..." required
                            style="width: 100%; padding: 5px;">
                    </div>
                @endguest

                @auth
                    <p>Đang bình luận với tên: <b>{{ Auth::user()->name }}</b></p>
                @endauth

                <div style="margin-bottom: 10px;">
                    <label>Nội dung:</label><br>
                    <textarea name="content" rows="3" placeholder="Nhập bình luận..." required
                        style="width: 100%; padding: 5px;"></textarea>
                </div>

                <button type="submit" style="padding: 10px 20px; cursor: pointer;">Gửi bình luận</button>
            </form>
        </div>
    </div>

</body>

</html>