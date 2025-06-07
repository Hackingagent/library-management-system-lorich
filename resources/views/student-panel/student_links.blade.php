@extends("layouts.student")
@section("content")
    <div class="container user-links-page py-5">
        <!-- Hero Section -->
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <div class="hero-bg p-5 rounded-lg" style="background: linear-gradient(135deg, rgba(220,53,69,0.1) 0%, rgba(220,53,69,0.05) 100%);">
                    <h2 class="page-heading display-4 font-weight-bold text-danger">External Resources</h2>
                    <p class="lead text-dark">Discover a world of knowledge with our curated collection</p>
                    <div class="divider mx-auto bg-danger"></div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="row mb-5 animate__animated animate__fadeIn">
            <div class="col-lg-8 mb-3 mb-lg-0">
                <div class="search-bar shadow-sm" style="border: 2px solid #dc3545;">
                    <input type="text" id="searchInput" class="form-control search-input" placeholder="🔍 Search resources..."
                        aria-label="Search resources">
                    <button class="btn btn-search" type="button" id="searchButton" style="background: #dc3545;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="filter-select">
                    <select id="categoryFilter" class="form-control select-dropdown" style="border: 2px solid #dc3545;">
                        <option value="all">All Categories</option>
                        <option value="site">Websites</option>
                        <option value="journal">Journals</option>
                        <option value="article">Articles</option>
                    </select>
                    <div class="select-icon text-danger">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resources Display Section -->
        <div class="row" id="resourcesContainer">
            @php
                $groupedLinks = [
                    'site' => [
                        ['title' => 'Example Research Site', 'url' => 'https://research.example.com', 'description' => 'Comprehensive research database with peer-reviewed papers', 'icon' => 'globe', 'color' => '#ff6b6b'],
                        ['title' => 'Online Encyclopedia', 'url' => 'https://encyclopedia.example.org', 'description' => 'Free online encyclopedia with millions of articles', 'icon' => 'book', 'color' => '#ff8e8e'],
                        ['title' => 'Academic Database', 'url' => 'https://academic.example.net', 'description' => 'Access to thousands of academic publications', 'icon' => 'database', 'color' => '#ffaaaa']
                    ],
                    'journal' => [
                        ['title' => 'Journal of Fictional Science', 'url' => 'https://jfs.example.edu', 'description' => 'Quarterly publication of cutting-edge fictional research', 'icon' => 'file-alt', 'color' => '#ff7676'],
                        ['title' => 'Modern Research Review', 'url' => 'https://mrr.example.com', 'description' => 'Interdisciplinary journal covering all fields of study', 'icon' => 'book-open', 'color' => '#ff8e8e']
                    ],
                    'article' => [
                        ['title' => 'Getting Started with Laravel', 'url' => 'https://laravel-docs.example.com/article1', 'description' => 'Beginner guide to Laravel framework', 'icon' => 'file-code', 'color' => '#ff6b6b'],
                        ['title' => 'Advanced Blade Techniques', 'url' => 'https://blade-pro.example.net/advanced', 'description' => 'Master advanced templating in Laravel', 'icon' => 'code', 'color' => '#ff8e8e'],
                        ['title' => 'The Future of Web Development', 'url' => 'https://web-future.example.org', 'description' => 'Analysis of emerging trends in web technologies', 'icon' => 'chart-line', 'color' => '#ffaaaa']
                    ]
                ];
            @endphp

            @foreach ($groupedLinks as $type => $linksOfType)
                @if (!empty($linksOfType))
                    <div class="col-md-12 mb-5 resource-section" data-category="{{ $type }}">
                        <div class="section-header d-flex align-items-center mb-4 p-3 rounded" style="background-color: rgba(220, 53, 69, 0.1); border-left: 5px solid #dc3545;">
                            <div class="header-icon bg-danger text-white rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 60px; height: 60px;">
                                <i class="fas @if($type=='site') fa-globe @elseif($type=='journal') fa-book-open @else fa-file-alt @endif fa-lg"></i>
                            </div>
                            <h3 class="m-0 text-danger font-weight-bold">{{ ucfirst($type) }} Resources</h3>
                            <span class="badge badge-pill badge-danger ml-auto px-3 py-2" style="font-size: 1rem;">{{ count($linksOfType) }} items</span>
                        </div>
                        
                        <div class="row">
                            @foreach ($linksOfType as $link)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <a href="{{ $link['url'] }}" class="resource-card card border-0 h-100 animate__animated animate__fadeInUp resource-item"
                                        data-title="{{ strtolower($link['title']) }}" data-category="{{ $type }}" target="_blank"
                                        style="box-shadow: 0 5px 15px rgba(220, 53, 69, 0.1); border-top: 3px solid {{ $link['color'] }};">
                                        <div class="card-body">
                                            <div class="resource-icon mb-3" style="color: {{ $link['color'] }};">
                                                <i class="fas fa-{{ $link['icon'] }} fa-2x"></i>
                                            </div>
                                            <h5 class="card-title font-weight-bold text-dark">{{ $link['title'] }}</h5>
                                            <p class="card-text text-muted">{{ $link['description'] ?? '' }}</p>
                                        </div>
                                        <div class="card-footer bg-transparent border-top-0 pt-0">
                                            <small class="font-weight-bold" style="color: {{ $link['color'] }};">Visit Resource <i class="fas fa-arrow-right ml-1"></i></small>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Empty State -->
        <div class="row d-none" id="noResults">
            <div class="col-md-12">
                <div class="empty-state text-center p-5 rounded-lg" style="background-color: rgba(220, 53, 69, 0.05);">
                    <div class="empty-state-icon bg-danger text-white rounded-circle mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                        <i class="fas fa-search fa-3x"></i>
                    </div>
                    <h3 class="text-danger mb-3 font-weight-bold">No resources found</h3>
                    <p class="text-dark mb-4">We couldn't find any resources matching your criteria</p>
                    <button class="btn btn-danger btn-lg px-4" id="resetFilters" style="box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);">
                        <i class="fas fa-redo mr-2"></i>Reset filters
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            background-color: #fafafa;
        }
        
        .hero-bg {
            position: relative;
            overflow: hidden;
        }
        
        .hero-bg::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(220,53,69,0.1) 0%, rgba(220,53,69,0) 70%);
            z-index: 0;
        }
        
        .page-heading {
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .divider {
            width: 100px;
            height: 4px;
            border-radius: 2px;
            margin: 1.5rem auto;
        }
        
        /* Search Bar Styles */
        .search-bar {
            position: relative;
            border-radius: 50px;
            overflow: hidden;
            background: white;
        }
        
        .search-input {
            border: none;
            padding: 15px 25px;
            height: auto;
            box-shadow: none !important;
            font-size: 1.1rem;
        }
        
        .search-input:focus {
            outline: none;
        }
        
        .btn-search {
            position: absolute;
            right: 5px;
            top: 5px;
            bottom: 5px;
            width: 50px;
            color: white;
            border: none;
            border-radius: 50px;
            transition: all 0.3s;
        }
        
        .btn-search:hover {
            background: #c82333 !important;
            transform: scale(1.05);
        }
        
        /* Filter Select Styles */
        .filter-select {
            position: relative;
        }
        
        .select-dropdown {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            padding: 15px 25px;
            border-radius: 50px !important;
            background: white;
            width: 100%;
            cursor: pointer;
            font-size: 1.1rem;
            color: #495057;
        }
        
        .select-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }
        
        /* Resource Card Styles */
        .resource-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-radius: 10px;
            overflow: hidden;
            background: white;
        }
        
        .resource-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 30px rgba(220, 53, 69, 0.2) !important;
            text-decoration: none;
        }
        
        .resource-card .card-title {
            transition: color 0.3s;
        }
        
        .resource-card:hover .card-title {
            color: #dc3545 !important;
        }
        
        .resource-icon {
            transition: all 0.3s;
        }
        
        .resource-card:hover .resource-icon {
            transform: scale(1.2);
        }
        
        /* Section Header Styles */
        .section-header {
            transition: all 0.3s;
        }
        
        .section-header:hover {
            background-color: rgba(220, 53, 69, 0.15) !important;
        }
        
        .header-icon {
            transition: all 0.3s;
            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);
        }
        
        /* Badge Styles */
        .badge-pill {
            transition: all 0.3s;
        }
        
        .section-header:hover .badge-pill {
            transform: scale(1.1);
            box-shadow: 0 4px 10px rgba(220, 53, 69, 0.3);
        }
        
        /* Empty State Styles */
        .empty-state {
            max-width: 600px;
            margin: 0 auto;
            transition: all 0.3s;
        }
        
        .empty-state-icon {
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }
        
        #resetFilters:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(220, 53, 69, 0.4) !important;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate__fadeInUp {
            animation-name: fadeInUp;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .page-heading {
                font-size: 2.2rem;
            }
            
            .hero-bg {
                padding: 3rem 1rem !important;
            }
            
            .resource-card {
                margin-bottom: 20px;
            }
            
            .section-header {
                flex-direction: column;
                text-align: center;
            }
            
            .header-icon {
                margin-bottom: 15px;
                margin-right: 0 !important;
            }
            
            .badge-pill {
                margin-top: 15px;
                margin-left: 0 !important;
            }
        }
    </style>

    @section('scripts')
        <script>
            $(document).ready(function () {
                // Initialize animations with staggered delay
                $('.resource-item').each(function (index) {
                    $(this).css('animation-delay', `${index * 0.1}s`);
                });
                
                // Add hover effect to cards
                $('.resource-card').hover(
                    function() {
                        $(this).addClass('animate__animated animate__pulse');
                    },
                    function() {
                        $(this).removeClass('animate__animated animate__pulse');
                    }
                );

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
                    $('html, body').animate({
                        scrollTop: $('#searchInput').offset().top - 100
                    }, 500);
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
                            $(this).closest('.col-lg-4').removeClass('d-none');
                            $(this).addClass('animate__animated animate__fadeInUp');
                            visibleItems++;
                        } else {
                            $(this).closest('.col-lg-4').addClass('d-none');
                        }
                    });

                    // Show/hide category sections based on visible items
                    $('.resource-section').each(function () {
                        const sectionCategory = $(this).data('category');
                        const sectionHasVisibleItems = $(this).find('.col-lg-4:not(.d-none)').length > 0;

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