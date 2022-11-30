<div class="d-flex flex-md-column align-items-start text-white min-vh-100 position-sticky pt-0 pt-md-4">
    <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
    </a>
    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
        <li class="nav-item">
            <h5>
                <a href="{{ route('binshopsblog.admin.index') }}" class="nav-link align-middle p-0">
                    <i class="fs-4"></i> <span class="d-block-inline">Dashboard</span>
                    <span class="text-muted d-none d-lg-inline">(<?php
                    $categoryCount = \BinshopsBlog\Models\BinshopsPost::count();
                    
                    echo $categoryCount . ' ' . str_plural('Post', $categoryCount);
                    
                    ?>)</span>
                </a>
                <small class="text-muted d-none d-lg-inline">Overview of your posts</small>
            </h5>
            <ul class="collapse show nav flex-column mb-2" id="submenu1" data-bs-parent="#menu">
                <li class="w-100">
                    <a href='{{ route('binshopsblog.admin.index') }}'
                        class='nav-link px-0 text-decoration-none @if (\Request::route()->getName() === 'binshopsblog.admin.index') active @endif  '>
                        <i class="bi bi-grid-3x3-gap-fill" aria-hidden="true"></i>
                        <span class="d-block-inline">All Post</span></a>
                </li>
                <li class="w-100">
                    <a href='{{ route('binshopsblog.admin.create_post') }}'
                        class='nav-link px-0 text-decoration-none @if (\Request::route()->getName() === 'binshopsblog.admin.create_post') active @endif  '>
                        <i class="bi bi-plus-circle-fill" aria-hidden="true"></i>
                        <span class="d-block-inline">Add Post</span></a>
                </li>
            </ul>
            <h5>
                <a href="{{ route('binshopsblog.admin.comments.index') }}" class="nav-link align-middle p-0">
                    <i class="fs-4"></i> <span class="d-block-inline">Comments</span>
                    <span class="text-muted d-none d-lg-inline">(<?php
                        $commentCount = \BinshopsBlog\Models\BinshopsComment::withoutGlobalScopes()->count();
                        
                        echo $commentCount . ' ' . str_plural('Comment', $commentCount);
                        
                        ?>)</span>
                </a>
                <small class="text-muted d-none d-lg-inline">Manage your comments</small>
            </h5>
            <ul class="collapse show nav flex-column  mb-2" id="submenu1" data-bs-parent="#menu">
                <li class="w-100">
                    <a href='{{ route('binshopsblog.admin.comments.index') }}'
                        class='nav-link px-0 text-decoration-none @if (\Request::route()->getName() === 'binshopsblog.admin.comments.index' &&
                        !\Request::get('waiting_for_approval')) active @endif  '>
                        <i class="bi bi-chat-left-text-fill" aria-hidden="true"></i>
                        <span class="d-block-inline">All Comments</span></a>
                </li>
                <li class="w-100">
                    <?php $comment_approval_count = \BinshopsBlog\Models\BinshopsComment::withoutGlobalScopes()->where("approved", false)->count(); ?>
                    <a href='{{ route('binshopsblog.admin.comments.index') }}?waiting_for_approval=true'
                        class='nav-link px-0 text-decoration-none @if(\Request::route()->getName() === 'binshopsblog.admin.comments.index' && \Request::get("waiting_for_approval")) active @elseif($comment_approval_count>0) list-group-item list-group-color-warning @endif  '>
                        <i class="bi bi-chat-right-text-fill" aria-hidden="true"></i>
                        <span class="d-block-inline">{{ $comment_approval_count }} Waiting for approval</span></a>
                </li>
            </ul>

        
            <h5>
                <a href="{{ route('binshopsblog.admin.categories.index') }}" class="nav-link align-middle p-0">
                    <i class="fs-4"></i> <span class="d-block-inline">Categories</span>
                    <span class="text-muted d-none d-lg-inline">(<?php
                        $postCount = \BinshopsBlog\Models\BinshopsCategory::count();
                        echo $postCount . ' ' . str_plural('Category', $postCount);
                        ?>)</span>
                </a>
                <small class="text-muted d-none d-lg-inline">Blog post categories</small>
            </h5>
            <ul class="collapse show nav flex-column  mb-2" id="submenu1" data-bs-parent="#menu">
                <li class="w-100">
                    <a href='{{ route('binshopsblog.admin.categories.index') }}'
                        class='nav-link px-0 text-decoration-none @if (\Request::route()->getName() === 'binshopsblog.admin.categories.index') active @endif  '>
                        <i class="bi bi-collection-fill" aria-hidden="true"></i>
                        <span class="d-block-inline">All Categories</span></a>
                </li>
                <li class="w-100">
                    <a href='{{ route('binshopsblog.admin.categories.create_category') }}'
                        class='nav-link px-0 text-decoration-none @if (\Request::route()->getName() === 'binshopsblog.admin.categories.create_category') active @endif  '>
                        <i class="bi bi-plus-circle-fill" aria-hidden="true"></i>
                        <span class="d-block-inline">Add Category</span></a>
                </li>
            </ul>
            <h5>
                <a href="{{ route('binshopsblog.admin.languages.index') }}" class="nav-link align-middle p-0">
                    <i class="fs-4"></i> <span class="d-block-inline">Languages</span>
                    <span class="text-muted d-none d-lg-inline">(<?php
                        $postCount = \BinshopsBlog\Models\BinshopsLanguage::count();
                        echo $postCount . ' ' . str_plural('Language', $postCount);
                        ?>)</span>
                </a>
                <small class="text-muted d-none d-lg-inline">Blog post categories</small>
            </h5>
            <ul class="collapse show nav flex-column  mb-2" id="submenu1" data-bs-parent="#menu">
                <li class="w-100">
                    <a href='{{ route('binshopsblog.admin.languages.index') }}'
                        class='nav-link px-0 text-decoration-none @if (\Request::route()->getName() === 'binshopsblog.admin.languages.index') active @endif  '>
                        <i class="bi bi-translate" aria-hidden="true"></i>
                        <span class="d-block-inline">All Languages</span></a>
                </li>
                <li class="w-100">
                    <a href='{{ route('binshopsblog.admin.languages.create_language') }}'
                        class='nav-link px-0 text-decoration-none @if (\Request::route()->getName() === 'binshopsblog.admin.languages.create_language') active @endif  '>
                        <i class="bi bi-plus-circle-fill" aria-hidden="true"></i>
                        <span class="d-block-inline">Add new Language</span></a>
                </li>
            </ul>
            @if (config('binshopsblog.image_upload_enabled'))
                <h5>
                    <a href="{{ route('binshopsblog.admin.images.upload') }}" class="nav-link align-middle p-0">
                        <i class="fs-4"></i> <span class="d-block-inline">Upload images</span>
                        <span class="text-muted d-none d-lg-inline">(<?php
                            $postCount = \BinshopsBlog\Models\BinshopsUploadedPhoto::count();
                            echo $postCount . ' ' . str_plural('Photos', $postCount);
                            ?>)</span>
                    </a>
                    <small class="text-muted d-none d-lg-inline">Upload images</small>
                </h5>
                <ul class="collapse show nav flex-column  mb-2" id="submenu1" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href='{{ route('binshopsblog.admin.images.all') }}'
                            class='nav-link px-0 text-decoration-none @if (\Request::route()->getName() === 'binshopsblog.admin.images.all') active @endif  '>
                            <i class="bi bi-image-fill" aria-hidden="true"></i>
                            <span class="d-block-inline">View All</span></a>
                    </li>
                    <li class="w-100">
                        <a href='{{ route('binshopsblog.admin.images.upload') }}'
                            class='nav-link px-0 text-decoration-none @if (\Request::route()->getName() === 'binshopsblog.admin.images.upload') active @endif  '>
                            <i class="bi bi-cloud-arrow-up-fill" aria-hidden="true"></i>
                            <span class="d-block-inline">Upload</span></a>
                    </li>
                </ul>
            @endif
        </li>
    </ul>
</div>
