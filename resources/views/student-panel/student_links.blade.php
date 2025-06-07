@extends("layouts.student")
@section("content")
    <div class="container user-links-page">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2 class="page-heading">External Resources</h2>
                <p class="text-muted">Explore useful external websites, journals, and articles curated by the library.</p>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="row mb-4 animate__animated animate__fadeIn">
            <div class="col-md-8">
                <div class="input-group">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search resources..."
                        aria-label="Search resources">
                    <div class="input-group-append">
                        <button class="btn btn-danger" type="button" id="searchButton">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <select id="categoryFilter" class="form-control">
                    <option value="all">All Categories</option>
                    <option value="site">Websites</option>
                    <option value="journal">Journals</option>
                    <option value="article">Articles</option>
                </select>
            </div>
        </div>

        <!-- Resources Display Section -->
        <div class="row" id="resourcesContainer">
            @php
                $groupedLinks = [
                    'site' => [
                        ['title' => 'Example Research Site', 'url' => 'https://research.example.com', 'description' => 'Comprehensive research database with peer-reviewed papers'],
                        ['title' => 'Online Encyclopedia', 'url' => 'https://encyclopedia.example.org', 'description' => 'Free online encyclopedia with millions of articles']
                    ],
                    'journal' => [
                        ['title' => 'Journal of Fictional Science', 'url' => 'https://jfs.example.edu', 'description' => 'Quarterly publication of cutting-edge fictional research'],
                    ],
                    'article' => [
                        ['title' => 'Getting Started with Laravel', 'url' => 'https://laravel-docs.example.com/article1', 'description' => 'Beginner guide to Laravel framework'],
                        ['title' => 'Advanced Blade Techniques', 'url' => 'https://blade-pro.example.net/advanced', 'description' => 'Master advanced templating in Laravel']
                    ]
                ];
            @endphp

            @foreach ($groupedLinks as $type => $linksOfType)
                @if (!empty($linksOfType))
                    <div class="col-md-12 mb-4 resource-section" data-category="{{ $type }}">
                        <div class="card border-0 shadow-sm animate__animated animate__fadeInUp">
                            <div class="card-header bg-white border-bottom-0">
                                <h4 class="m-0">
                                    <span class="badge badge-danger mr-2">{{ strtoupper($type) }}</span>
                                    {{ ucfirst($type) }}s
                                </h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="list-group list-group-flush">
                                    @foreach ($linksOfType as $link)
                                        <a href="{{ $link['url'] }}" class="list-group-item list-group-item-action resource-item"
                                            data-title="{{ strtolower($link['title']) }}" data-category="{{ $type }}" target="_blank">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">{{ $link['title'] }}</h5>
                                                <small class="text-danger"><i class="fas fa-external-link-alt"></i></small>
                                            </div>
                                            <p class="mb-1">{{ $link['description'] ?? '' }}</p>
                                            <small class="text-muted">{{ $link['url'] }}</small>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Empty State -->
        <div class="row d-none" id="noResults">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm animate__animated animate__fadeIn">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-search fa-3x text-danger mb-3"></i>
                        <h4 class="text-dark">No resources found</h4>
                        <p class="text-muted">Try adjusting your search or filter criteria</p>
                        <button class="btn btn-outline-danger" id="resetFilters">Reset filters</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .page-heading {
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
            color: #343a40;
            position: relative;
        }

        .page-heading:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 80px;
            height: 2px;
            background: #dc3545;
        }

        .resource-item {
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .resource-item:hover {
            transform: translateX(5px);
            border-left: 3px solid #dc3545;
            background-color: #f8f9fa;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        .animate__animated {
            animation-duration: 0.5s;
        }

        #categoryFilter,
        #searchInput {
            border: 1px solid #ddd;
            transition: all 0.3s;
        }

        #categoryFilter:focus,
        #searchInput:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .card {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>

    @section('scripts')
        <script>
            $(document).ready(function () {
                // Initialize animations
                $('.resource-section').each(function (index) {
                    $(this).css('animation-delay', `${index * 0.1}s`);
                });

                // Filter functionality
                $('#categoryFilter').change(function () {
                    filterResources();
                });

                // Search functionality
                $('#searchButton').click(filterResources);
                $('#searchInput').keyup(function (e) {
                    if (e.keyCode === 13) filterResources();
                });

                // Reset filters
                $('#resetFilters').click(function () {
                    $('#categoryFilter').val('all');
                    $('#searchInput').val('');
                    filterResources();
                });

                function filterResources() {
                    const category = $('#categoryFilter').val();
                    const searchTerm = $('#searchInput').val().toLowerCase();
                    let visibleItems = 0;

                    $('.resource-item').each(function () {
                        const itemCategory = $(this).data('category');
                        const itemTitle = $(this).data('title');
                        const matchesCategory = category === 'all' || itemCategory === category;
                        const matchesSearch = searchTerm === '' || itemTitle.includes(searchTerm);

                        if (matchesCategory && matchesSearch) {
                            $(this).removeClass('d-none').addClass('animate__animated animate__fadeIn');
                            visibleItems++;
                        } else {
                            $(this).addClass('d-none');
                        }
                    });

                    // Show/hide category sections based on visible items
                    $('.resource-section').each(function () {
                        const sectionCategory = $(this).data('category');
                        const sectionHasVisibleItems = $(this).find('.resource-item:not(.d-none)').length > 0;

                        if ((category === 'all' || sectionCategory === category) && sectionHasVisibleItems) {
                            $(this).removeClass('d-none').addClass('animate__animated animate__fadeIn');
                        } else {
                            $(this).addClass('d-none');
                        }
                    });

                    // Show no results message if needed
                    if (visibleItems === 0) {
                        $('#noResults').removeClass('d-none').addClass('animate__animated animate__fadeIn');
                        $('#resourcesContainer').addClass('d-none');
                    } else {
                        $('#noResults').addClass('d-none');
                        $('#resourcesContainer').removeClass('d-none');
                    }
                }
            });
        </script>
    @endsection
@endsection