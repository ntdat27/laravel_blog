<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <title>Blog Tối Giản</title>
</head>

<body style="
            font-family: sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        ">
    <div style="
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 2px solid #333;
                padding-bottom: 10px;
                margin-bottom: 20px;
            ">
        <h2>📝 Blog Của Tôi</h2>

        <div>
            @auth
                <span>Chào, <b>{{ Auth::user()->name }}</b></span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline">
                    @csrf
                    <button type="submit" style="margin-left: 10px; color: red; cursor: pointer">
                        Đăng xuất
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" style="margin-right: 10px">Đăng Nhập</a>
                <a href="{{ route('register') }}">Đăng Ký</a>
            @endauth
        </div>
    </div>

    <div>
        @foreach($posts as $post)
            <div style="
                        margin-bottom: 20px;
                        border: 1px solid #ddd;
                        padding: 15px;
                        border-radius: 5px;
                    ">
                <h3 style="margin-top: 0">
                    <a href="{{ route('posts.show', $post->id) }}" style="text-decoration: none; color: blue">
                        {{ $post->title }}
                    </a>
                </h3>
                <p>{{ $post->description }}</p>
                <small style="color: gray">Tác giả:
                    {{ $post->user ? $post->user->name : 'Ẩn danh' }}</small>
            </div>
        @endforeach
    </div>
</body>

</html>