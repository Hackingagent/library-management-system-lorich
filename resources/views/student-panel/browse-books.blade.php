@extends("layouts.student")
@section("content")
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Library Book Catalog</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f5f5f5;
                color: #333;
            }

            .library-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }

            .header {
                background: linear-gradient(to right, #e52d27, #b31217);
                color: white;
                padding: 40px 20px;
                text-align: center;
                border-radius: 10px;
                margin-bottom: 30px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            .header h1 {
                font-size: 2.5rem;
                margin-bottom: 15px;
            }

            .search-box {
                max-width: 600px;
                margin: 0 auto;
                position: relative;
            }

            .search-box input {
                width: 100%;
                padding: 15px 20px;
                border: none;
                border-radius: 30px;
                font-size: 16px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            .search-box button {
                position: absolute;
                right: 5px;
                top: 5px;
                background: #e52d27;
                color: white;
                border: none;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                cursor: pointer;
            }

            .filter-section {
                display: flex;
                justify-content: space-between;
                margin-bottom: 30px;
                flex-wrap: wrap;
            }

            .filter-buttons {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
            }

            .filter-btn {
                background: white;
                border: none;
                padding: 10px 20px;
                border-radius: 20px;
                cursor: pointer;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .filter-btn.active,
            .filter-btn:hover {
                background: #e52d27;
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 5px 10px rgba(229, 45, 39, 0.3);
            }

            .sort-select {
                padding: 10px 20px;
                border: none;
                border-radius: 20px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .books-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 30px;
            }

            .book-card {
                background: white;
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .book-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            }

            .book-image {
                height: 300px;
                position: relative;
                overflow: hidden;
            }

            .book-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.5s ease;
            }

            .book-card:hover .book-image img {
                transform: scale(1.1);
            }

            .book-status {
                position: absolute;
                top: 10px;
                right: 10px;
                padding: 5px 10px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: bold;
                color: white;
            }

            .available {
                background-color: #4CAF50;
            }

            .unavailable {
                background-color: #e52d27;
            }

            .book-info {
                padding: 20px;
            }

            .book-title {
                font-size: 18px;
                font-weight: bold;
                margin-bottom: 5px;
            }

            .book-author {
                color: #e52d27;
                margin-bottom: 10px;
            }

            .book-rating {
                color: #FFD700;
                margin-bottom: 10px;
            }

            .book-meta {
                display: flex;
                justify-content: space-between;
                color: #666;
                margin-bottom: 15px;
                font-size: 14px;
            }

            .book-actions {
                display: flex;
                gap: 10px;
            }

            .borrow-btn {
                flex: 1;
                background: #e52d27;
                color: white;
                border: none;
                padding: 10px;
                border-radius: 5px;
                cursor: pointer;
                transition: background 0.3s ease;
            }

            .borrow-btn:hover {
                background: #b31217;
            }

            .borrow-btn.disabled {
                background: #ccc;
                cursor: not-allowed;
            }

            .wishlist-btn {
                width: 40px;
                background: #f5f5f5;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .wishlist-btn:hover {
                background: #ffebee;
                color: #e52d27;
            }

            @media (max-width: 768px) {
                .filter-section {
                    flex-direction: column;
                    gap: 15px;
                }

                .books-grid {
                    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                }
            }
        </style>
    </head>

    <body>
        <div class="library-container">
            <div class="header">
                <h1>Digital Library Collection</h1>
                <div class="search-box">
                    <form action="{{ route('student.books') }}" method="GET">
                        <input type="text" name="search" placeholder="Search for books, authors..." value="{{ request('search') }}">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="filter-section">
                <div class="filter-buttons">
                    <button class="filter-btn active">All Books</button>
                    <button class="filter-btn">Fiction</button>
                    <button class="filter-btn">Science</button>
                    <button class="filter-btn">History</button>
                    <button class="filter-btn">Available</button>
                </div>
                <form action="" method="GET">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <select class="sort-select" name="sort" onchange="this.form.submit()">
                        <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Sort by Title</option>
                        <option value="author" {{ request('sort') == 'author' ? 'selected' : '' }}>Sort by Author</option>
                        <option value="year" {{ request('sort') == 'year' ? 'selected' : '' }}>Sort by Year</option>
                    </select>
                </form>
            </div>

            <div class="books-grid">
                <!-- Book 1 -->
                @foreach ($books as $book)

                    <div class="book-card">
                        <div class="book-image">
                            @if($book->file)
                                <img src="{{ asset('storage/' . $book->file->path) }}" alt="Book Image" width="100">
                            @else
                                No file
                            @endif

                            @if ($book->status == 'Y')
                                <div class="book-status available">Available</div>
                            @else
                                <div class="book-status unavailable">Checked Out</div>

                            @endif
                        </div>
                        <div class="book-info">
                            <h3 class="book-title">{{$book->name}}</h3>
                            <p class="book-author">{{ $book->auther->name }}</p>
                            {{-- <div class="book-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div> --}}
                            <div class="book-meta">
                                <span>{{$book->category->name}}</span>
                                <span>{{$book->created_at->format('Y')}}</span>
                            </div>
                            <div class="book-actions">
                                @if ($book->status == 'Y')
                                    <button class="borrow-btn">Borrow Now</button>
                                @else
                                    <button class="borrow-btn disabled">Unavailable</button>

                                @endif
                                <button class="wishlist-btn"><i class="fas fa-heart"></i></button>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Filter buttons
                const filterButtons = document.querySelectorAll('.filter-btn');
                filterButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        filterButtons.forEach(btn => btn.classList.remove('active'));
                        this.classList.add('active');
                    });
                });

                // Wishlist buttons
                const wishlistButtons = document.querySelectorAll('.wishlist-btn');
                wishlistButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        this.classList.toggle('active');
                        const icon = this.querySelector('i');
                        if (this.classList.contains('active')) {
                            icon.classList.remove('far');
                            icon.classList.add('fas');
                            this.style.color = '#e52d27';
                        } else {
                            icon.classList.remove('fas');
                            icon.classList.add('far');
                            this.style.color = '';
                        }
                    });
                });
            });
        </script>
    </body>

    </html>
@endsection