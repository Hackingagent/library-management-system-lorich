@extends('layouts.student')

@section('content')
    <div class="container user-links-page">
        <!-- Header Section -->
        <header class="page-header py-5 mb-5 animate__animated animate__fadeIn">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto text-center">
                        <h1 class="display-4 fw-bold mb-3">Library Catalog</h1>
                        <p class="lead mb-4">Browse our collection of available books</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Filter and Search Section -->
        <div class="filter-section animate__animated animate__fadeIn">
            <div class="row">
                <div class="col-md-8">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" class="form-control"
                            placeholder="Search by title, author, or ISBN...">
                    </div>
                </div>
                <div class="col-md-4">
                    <select id="genreFilter" class="form-select">
                        <option value="all">All Genres</option>
                        <option value="fiction">Fiction</option>
                        <option value="non-fiction">Non-Fiction</option>
                        <option value="science">Science</option>
                        <option value="history">History</option>
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <h6 class="mb-2">Quick Filters:</h6>
                    <div class="filter-tags">
                        <span class="filter-tag active" data-filter="all">All</span>
                        <span class="filter-tag" data-filter="available">Available Now</span>
                        <span class="filter-tag" data-filter="new">New Arrivals</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Books Grid -->
        <div class="row" id="booksContainer">
            @foreach($books as $book)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4 animate__animated animate__fadeIn">
                    <div class="book-card">
                        <div class="book-cover" style="background-image: url('{{ $book->cover_url }}')">
                            <span class="book-badge {{ $book->available ? 'bg-success' : 'bg-warning' }} text-white">
                                {{ $book->available ? 'Available' : 'Checked Out' }}
                            </span>
                        </div>
                        <div class="card-body">
                            <h5 class="book-title">{{ $book->title }}</h5>
                            <p class="book-author">by {{ $book->author }}</p>
                            <p class="book-description">{{ Str::limit($book->description, 100) }}</p>
                            <div class="book-meta">
                                <span class="book-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= floor($book->rating))
                                            <i class="fas fa-star"></i>
                                        @elseif($i == ceil($book->rating) && $book->rating % 1 != 0)
                                            <i class="fas fa-star-half-alt"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </span>
                                <span>{{ $book->published_year }}</span>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <button class="btn btn-book-secondary btn-sm">
                                    <i class="far fa-bookmark"></i> Save
                                </button>
                                <button class="btn btn-book btn-sm {{ $book->available ? '' : 'disabled' }}">
                                    <i class="fas fa-book"></i> Borrow
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- No Results Message -->
        <div class="no-results d-none animate__animated animate__fadeIn" id="noResults">
            <i class="fas fa-book-open"></i>
            <h3 class="mb-3">No Books Found</h3>
            <p class="text-muted mb-4">Try adjusting your search or filter criteria</p>
            <button class="btn btn-book" id="resetFilters">Reset All Filters</button>
        </div>

        <!-- Pagination -->
        <div class="mt-5">
            {{ $books->links() }}
        </div>
    </div>

    <!-- Floating Action Button -->
    <div class="floating-action-btn animate__animated animate__fadeInUp">
        <i class="fas fa-filter"></i>
    </div>
@endsection

@section('styles')
    <style>
        .page-header {
            background: linear-gradient(135deg, #4361ee, #3f37c9);
            color: white;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 10px 20px rgba(67, 97, 238, 0.2);
        }

        .book-card {
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            height: 100%;
        }

        .book-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .book-cover {
            height: 250px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .book-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 2;
        }

        .filter-tag {
            display: inline-block;
            padding: 5px 15px;
            background-color: #f8f9fa;
            border-radius: 50px;
            margin-right: 10px;
            cursor: pointer;
        }

        .filter-tag.active {
            background-color: #4361ee;
            color: white;
        }

        .floating-action-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #f72585;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 5px 20px rgba(247, 37, 133, 0.4);
            cursor: pointer;
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            // Filter functionality
            $('#searchInput, #genreFilter').on('input change', filterBooks);
            $('.filter-tag').click(function () {
                $('.filter-tag').removeClass('active');
                $(this).addClass('active');
                filterBooks();
            });

            function filterBooks() {
                const searchTerm = $('#searchInput').val().toLowerCase();
                const genreFilter = $('#genreFilter').val();
                const quickFilter = $('.filter-tag.active').data('filter');

                let visibleBooks = 0;

                $('.book-card').parent().each(function () {
                    const $card = $(this);
                    const title = $card.find('.book-title').text().toLowerCase();
                    const author = $card.find('.book-author').text().toLowerCase();
                    const genre = $card.data('genre'); // Add data-genre to your book cards
                    const status = $card.find('.book-badge').text().trim();
                    const isNew = $card.data('new'); // Add data-new for new arrivals

                    const matchesSearch = title.includes(searchTerm) || author.includes(searchTerm);
                    const matchesGenre = genreFilter === 'all' || genre === genreFilter;
                    let matchesQuickFilter = true;

                    if (quickFilter === 'available') {
                        matchesQuickFilter = status === 'Available';
                    } else if (quickFilter === 'new') {
                        matchesQuickFilter = isNew;
                    }

                    if (matchesSearch && matchesGenre && matchesQuickFilter) {
                        $card.removeClass('d-none').addClass('animate__fadeIn');
                        visibleBooks++;
                    } else {
                        $card.addClass('d-none');
                    }
                });

                if (visibleBooks === 0) {
                    $('#noResults').removeClass('d-none');
                    $('#booksContainer').addClass('d-none');
                } else {
                    $('#noResults').addClass('d-none');
                    $('#booksContainer').removeClass('d-none');
                }
            }

            // Floating button click handler
            $('.floating-action-btn').click(function () {
                $('html, body').animate({
                    scrollTop: $('.filter-section').offset().top - 20
                }, 500);
            });
        });
    </script>
@endsection