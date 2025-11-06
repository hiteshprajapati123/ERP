@extends('layouts.app')

@push('styles')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
@endpush

@section('content')
<div style="overflow-x: hidden;">
<!-- Hero Section -->
<section style="background: linear-gradient(135deg, #1A5D3B 0%, #2c8a5a 100%); color: white; padding: 100px 0 80px; position: relative; overflow: hidden;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url('https://images.unsplash.com/photo-1519817650390-64a93db51149?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80') center/cover no-repeat; opacity: 0.15;"></div>
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; position: relative; z-index: 1; text-align: center;">
        <h1 style="font-size: 48px; font-weight: 800; margin: 0 0 15px; letter-spacing: -0.5px;">Our Gallery</h1>
        <p style="font-size: 18px; max-width: 700px; margin: 0 auto 25px; line-height: 1.6;">Explore the vibrant life and activities at our institute through our photo collection</p>
        <div style="width: 80px; height: 4px; background: #D4AF37; margin: 0 auto 30px;"></div>
    </div>
</section>

<!-- Gallery Section -->
<section style="padding: 80px 0; background: #f8f9fa; position: relative;">
    <!-- Decorative Elements -->
    <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: rgba(26, 93, 59, 0.05); border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;"></div>
    <div style="position: absolute; bottom: -100px; left: -50px; width: 400px; height: 400px; background: rgba(212, 175, 55, 0.1); border-radius: 50%;"></div>
    
    <div style="max-width: 1200px; width: 100%; margin: 0 auto; padding: 0 15px; position: relative; z-index: 1; box-sizing: border-box;">
        <!-- Filter Buttons -->
        <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 10px; margin-bottom: 40px; width: 100%; max-width: 100%; padding: 0 10px; box-sizing: border-box;">
            @php
                // Add 'All' as the first category
                $allCategories = ['all' => 'All'] + $categories;
            @endphp
            
            @foreach($allCategories as $key => $category)
                @php
                    // Set the first button as active and style it differently
                    $isFirst = $loop->first;
                    $btnStyle = $isFirst 
                        ? 'background: #1A5D3B; color: white; border: none; padding: 10px 25px 10px 20px;' 
                        : 'background: #f8f9fa; color: #1A5D3B; border: 2px solid #1A5D3B; padding: 8px 23px 8px 18px;';
                @endphp
                <button class="filter-btn {{ $isFirst ? 'active' : '' }}" 
                        data-filter="{{ $key }}" 
                        style="{{ $btnStyle }} border-radius: 50px; cursor: pointer; font-weight: 600; transition: all 0.3s ease; position: relative; overflow: hidden; display: flex; align-items: center; gap: 8px;">
                    <span>{{ $category }}</span>
                    <span class="arrow-icon" style="display: inline-flex; transition: transform 0.3s ease; margin-left: 0;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </span>
                </button>
            @endforeach
        </div>

        <!-- Gallery Grid -->
        <div class="gallery-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 25px; margin: 0 auto; width: 100%; box-sizing: border-box;">
            @forelse($initialItems as $item)
                <div class="gallery-item" data-category="{{ strtolower($item['category']) }}" style="position: relative; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08); transition: all 0.4s ease; aspect-ratio: 1/1;">
                    <img src="{{ $item['image'] }}" alt="{{ $item['alt'] ?? $item['title'] }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;">
                    <div class="gallery-item-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to top, rgba(26, 93, 59, 0.9) 0%, rgba(26, 93, 59, 0.1) 60%); display: flex; flex-direction: column; justify-content: flex-end; padding: 20px; opacity: 0; transition: all 0.4s ease; color: white; text-align: left;">
                        <h3 style="margin: 0 0 5px; font-size: 18px; font-weight: 600; transform: translateY(20px); transition: transform 0.4s ease 0.1s;">{{ $item['title'] }}</h3>
                        <p style="margin: 0; font-size: 14px; opacity: 0.9; transform: translateY(20px); transition: transform 0.4s ease 0.15s;">{{ $item['description'] }}</p>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px 0;">
                    <p>No gallery items found.</p>
                </div>
            @endforelse
        </div>

        <!-- Load More Button -->
        <div style="text-align: center; margin-top: 50px;">
            <button id="load-more" style="background: #1A5D3B; color: white; border: none; padding: 14px 35px; border-radius: 50px; font-weight: 600; font-size: 16px; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center;">
                Load More
                <i class="bi bi-arrow-down ms-2" style="transition: transform 0.3s ease;"></i>
            </button>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('load-more');
    const galleryGrid = document.querySelector('.gallery-grid');
    let currentPage = 1;
    let isLoading = false;
    let hasMore = true;
    const selectedCategory = 'all'; // Default category

    loadMoreBtn.addEventListener('click', loadMoreItems);

    // Initial check for items
    checkIfMoreItems();

    async function loadMoreItems() {
        if (isLoading || !hasMore) return;
        
        isLoading = true;
        loadMoreBtn.disabled = true;
        loadMoreBtn.innerHTML = 'Loading...';
        
        try {
            currentPage++;
            const response = await fetch(`/gallery/items?page=${currentPage}&category=${selectedCategory}`);
            const data = await response.json();
            
            if (data.items && data.items.length > 0) {
                // Append new items to the grid
                const fragment = document.createDocumentFragment();
                
                data.items.forEach(item => {
                    const itemElement = createGalleryItem(item);
                    fragment.appendChild(itemElement);
                });
                
                galleryGrid.appendChild(fragment);
                
                // Check if there are more items to load
                hasMore = data.current_page < data.last_page;
                loadMoreBtn.style.display = hasMore ? 'inline-flex' : 'none';
            } else {
                hasMore = false;
                loadMoreBtn.style.display = 'none';
            }
        } catch (error) {
            console.error('Error loading more items:', error);
            hasMore = false;
            loadMoreBtn.style.display = 'none';
        } finally {
            isLoading = false;
            loadMoreBtn.disabled = false;
            loadMoreBtn.innerHTML = 'Load More <i class="bi bi-arrow-down ms-2" style="transition: transform 0.3s ease;"></i>';
        }
    }
    
    function createGalleryItem(item) {
        const itemDiv = document.createElement('div');
        itemDiv.className = 'gallery-item';
        itemDiv.dataset.category = item.category.toLowerCase();
        itemDiv.style.cssText = 'position: relative; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08); transition: all 0.4s ease; aspect-ratio: 1/1;';
        
        itemDiv.innerHTML = `
            <img src="${item.image}" alt="${item.alt || item.title}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;">
            <div class="gallery-item-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to top, rgba(26, 93, 59, 0.9) 0%, rgba(26, 93, 59, 0.1) 60%); display: flex; flex-direction: column; justify-content: flex-end; padding: 20px; opacity: 0; transition: all 0.4s ease; color: white; text-align: left;">
                <h3 style="margin: 0 0 5px; font-size: 18px; font-weight: 600; transform: translateY(20px); transition: transform 0.4s ease 0.1s;">${item.title}</h3>
                <p style="margin: 0; font-size: 14px; opacity: 0.9; transform: translateY(20px); transition: transform 0.4s ease 0.15s;">${item.description || ''}</p>
            </div>
        `;
        
        return itemDiv;
    }
    
    // Check if there are more items to load
    async function checkIfMoreItems() {
        try {
            const response = await fetch(`/gallery/items?page=1&category=${selectedCategory}`);
            const data = await response.json();
            hasMore = data.current_page < data.last_page;
            loadMoreBtn.style.display = hasMore ? 'inline-flex' : 'none';
        } catch (error) {
            console.error('Error checking for more items:', error);
            loadMoreBtn.style.display = 'none';
        }
    }
    
    // Add hover effects
    document.addEventListener('mouseover', function(e) {
        const item = e.target.closest('.gallery-item');
        if (!item) return;
        
        const overlay = item.querySelector('.gallery-item-overlay');
        const title = overlay.querySelector('h3');
        const description = overlay.querySelector('p');
        const img = item.querySelector('img');
        
        overlay.style.opacity = '1';
        title.style.transform = 'translateY(0)';
        description.style.transform = 'translateY(0)';
        img.style.transform = 'scale(1.05)';
    });
    
    document.addEventListener('mouseout', function(e) {
        const item = e.target.closest('.gallery-item');
        if (!item) return;
        
        const overlay = item.querySelector('.gallery-item-overlay');
        const title = overlay.querySelector('h3');
        const description = overlay.querySelector('p');
        const img = item.querySelector('img');
        
        overlay.style.opacity = '0';
        title.style.transform = 'translateY(20px)';
        description.style.transform = 'translateY(20px)';
        img.style.transform = 'scale(1)';
    });
    
    // Initial check for more items when the page loads
    checkIfMoreItems();
});
</script>
@endpush

<style>
    /* Responsive adjustments */
    @media (max-width: 992px) {
        .gallery-grid {
            grid-template-columns: repeat(3, 1fr) !important;
        }
    }
    @media (max-width: 768px) {
        .gallery-grid {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }
    @media (max-width: 576px) {
        .gallery-grid {
            grid-template-columns: 1fr !important;
        }
    }

    /* Hover Effects */
    .gallery-item:hover {
        transform: translateY(-8px) !important;
        box-shadow: 0 15px 40px rgba(0,0,0,0.15) !important;
    }

    .gallery-item:hover .gallery-item-overlay {
        opacity: 1 !important;
    }

    .gallery-item:hover .gallery-item-overlay h3,
    .gallery-item:hover .gallery-item-overlay p {
        transform: translateY(0) !important;
    }

    /* Filter Button Active State */
    .filter-btn.active {
        background: #1A5D3B !important;
        color: white !important;
        border-color: #1A5D3B !important;
    }

    /* Button Hover Effects */
    #load-more:hover {
        background: #14422c !important;
        transform: translateY(-3px) !important;
        box-shadow: 0 8px 20px rgba(26, 93, 59, 0.25) !important;
    }
    
    /* Filter button hover effects */
    .filter-btn {
        position: relative;
        overflow: hidden;
    }
    
    .filter-btn .arrow-icon {
        opacity: 0;
        transform: translateX(-10px);
        transition: all 0.3s ease;
    }
    
    .filter-btn:hover .arrow-icon {
        opacity: 1;
        transform: translateX(0);
    }
    
    .filter-btn:hover {
        padding-right: 25px !important;
        padding-left: 25px !important;
    }
    
    .filter-btn.active {
        padding-right: 25px !important;
        padding-left: 20px !important;
    }
    
    .filter-btn.active .arrow-icon {
        opacity: 1;
        transform: translateX(0);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality
        const filterBtns = document.querySelectorAll('.filter-btn');
        const galleryItems = document.querySelectorAll('.gallery-item');
        
        function setActiveButton(button) {
            // Remove active class from all buttons and reset styles
            filterBtns.forEach(b => {
                b.classList.remove('active');
                b.style.background = '#f8f9fa';
                b.style.color = '#1A5D3B';
                b.style.border = '2px solid #1A5D3B';
                b.style.padding = '8px 23px 8px 18px';
            });
            
            // Add active class to clicked button and update styles
            button.classList.add('active');
            button.style.background = '#1A5D3B';
            button.style.color = 'white';
            button.style.border = 'none';
            button.style.padding = '10px 25px 10px 20px';
            
            // Filter items
            const filter = button.getAttribute('data-filter');
            galleryItems.forEach(item => {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }
        
        // Initialize with 'All' active
        const initialActiveBtn = document.querySelector('.filter-btn[data-filter="all"]');
        if (initialActiveBtn) setActiveButton(initialActiveBtn);
        
        // Add click event to all filter buttons
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                setActiveButton(this);
            });
        });
    });
</script>
</div>
@endsection