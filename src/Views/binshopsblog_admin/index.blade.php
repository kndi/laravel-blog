@extends('binshopsblog_admin::layouts.admin_layout')
@section('content')



    <h5>Admin - Manage Blog Posts</h5>


    <?php
    $oldId = 0;
    ?>

    @forelse($post_translations as $post)
          {{--  <?php
        echo '<pre>';
        var_dump($post_translations);
        
        echo '</pre>';
        ?>    --}}
        <?php
        
        if ($oldId == 0) {
            echo '<article class="card m-4 bg-light" >';
        
            $oldId = $post->post_id;
        }
        
        $newId = $post->post_id;
        
        if ($oldId != $newId) {
            ?>
        <div class='row ml-4 mb-4'>
            <form onsubmit='return confirm('Are you sure you want to delete this blog post?\n You cannot undo this
                action!');' method='post' action='{{ route('binshopsblog.admin.destroy_post', $post->post_id) }}'
                class=''>
                @csrf
                <input name='_method' type='hidden' value='DELETE' />
                <button type='submit' class='btn btn-danger btn-sm' style='float:left; margin-left:24px;'>
                    <i class='bi bi-trash-fill' aria-hidden='true'></i>
                    Delete
                </button>
            </form>
        </div>
        </article>
        <article class="card m-4 bg-light">
            <?php
        }
        $oldId = $post->post_id;
        
        ?>
            <div class="row m-4 pt-3 pb-3 border">

                <div class="col-md-7 col-sm-6 col-lg-6 col-xs-6 col-xl-5 control-label">
                    <a class="a-link-cart-color h4"
                        href='{{ $post->url(app('request')->get('locale')) }}'>{{ $post->title }}</a>
                    <p class="h5 pt-2">{{ $post->subtitle }}</p>

                </div>
                {{--  <div class="col-1">
                    Message?: <p class="card-text">{{ $post->html }}</p>
                </div>  --}}

                <div class="col-md-5 col-sm-4 col-lg-6 col-xs-6 col-xl-4 control-label">
                    <p class="m-0"><span class="fw-bold">Author:</span> {{ $post->post->author->profile->full_name }}
                        {{--  {{ $post->post->author_string() }}{{ $post->post->user_id }}</p> - vana kood, jätan alle vb vaja  --}}
                        
                        
                    <p class="m-0 mt-2"><span class="fw-bold">Posted At:</span> {{ $post->post->posted_at }}</p>
                    <p class="m-0 mt-2"><span class="fw-bold">Published?:</span> {!! $post->post->is_published ? 'Yes' : '<span class="border border-danger rounded p-1">No</span>' !!} </p>
                </div>

                {{--  <div class="col-2">
                    <p class="m-0 fw-bold pb-1">Published?:</p>
                    <p>{!! $post->post->is_published ? 'Yes' : '<span class="border border-danger rounded p-1">No</span>' !!}</p>
                </div>  --}}
                {{--  <div class="col-1">
                    @if ($post->use_view_file)
                        <h5>Uses Custom Viewfile:</h5>
                        <div class="m-2 p-1">
                            <strong>View file:</strong><br>
                            <code>{{ $post->use_view_file }}</code>

                            <?php
                            
                            $viewfile = resource_path('views/custom_blog_posts/' . $post->use_view_file . '.blade.php');
                            
                            ?>
                            <br>
                            <strong>Full filename:</strong>
                            <br>
                            <small>
                                <code>{{ $viewfile }}</code>
                            </small>

                            @if (!file_exists($viewfile))
                                <div class='alert alert-danger'>Warning! The custom view file does not exist. Create the
                                    file for this post to display correctly.
                                </div>
                            @endif

                        </div>
                    @endif
                </div>  --}}
                <div class="col-md-6 col-sm-0 col-lg-6 col-xs-0 col-xl-2 control-label img-fluid d-none d-md-block">
                    <?= $post->image_tag('thumbnail', false, 'float-right') ?>
                </div>

                <div class="col-md-6 col-sm-2 col-lg-6 col-xs-2 col-xl-1 control-label">
                    <div class="float-end">
                        <p class="m-1">
                            <?php
                            if ($post->lang_id == '1') {
                                echo 'ENG';
                            } elseif ($post->lang_id == '2') {
                                echo 'EST';
                            } elseif ($post->lang_id == '3') {
                                echo 'LV';
                            } elseif ($post->lang_id == '4') {
                                echo 'LT';
                            } else {
                                echo 'UNKNOWN';
                            }
                            ?>
                        </p>
                        <p class="m-1">
                            <a href="{{ $post->url(app('request')->get('locale')) }}"
                                class="btn-sm btn btn-outline-secondary" style=""><i class="bi bi-file-text-fill"
                                    aria-hidden="true"></i>
                            </a>
                        </p>
                        <p class="m-1">
                            <a href="{{ $post->edit_url() }}" class="btn-sm btn btn-primary" style="">
                                <i class="data-table-button-icon bi bi-pencil-square" aria-hidden="true"></i>
                            </a>
                        </p>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12 col-xl-12 control-label">
                    @if (count($post->post->categories))
                        @foreach ($post->post->categories as $category)
                            <a class='btn btn-outline-secondary btn-sm'
                                href='{{ $category->categoryTranslations->where('lang_id', $language_id)->first()->edit_url() }}'>
                                <i class="bi bi-pencil-square" aria-hidden="true"></i>

                                {{ $category->categoryTranslations->where('lang_id', $language_id)->first()->category_name }}
                            </a>
                        @endforeach
                    @else
                        No Categories
                    @endif

                </div>

                {{--  <div class="col-2 pt-3 d-inline-flex">

                    <p class="test">
                        <?php
                        if ($post->lang_id == '1') {
                            echo 'ENG';
                        } elseif ($post->lang_id == '2') {
                            echo 'EST';
                        } elseif ($post->lang_id == '3') {
                            echo 'LV';
                        } elseif ($post->lang_id == '4') {
                            echo 'LT';
                        } else {
                            echo 'UNKNOWN';
                        }
                        ?>
                    </p>
                    <a href="{{ $post->url(app('request')->get('locale')) }}" class="btn-sm btn btn-outline-secondary mx-2"
                        style=""><i class="bi bi-file-text-fill" aria-hidden="true"></i>
                    </a>
                    <a href="{{ $post->edit_url() }}" class="btn-sm btn btn-primary" style="">
                        <i class="data-table-button-icon bi bi-pencil-square" aria-hidden="true"></i>
                    </a>

                </div>  --}}
            </div>
        @empty
            <div class='alert alert-warning'>No posts to show you. Why dont you add one?</div>
    @endforelse
    <div class='row ml-4 mb-4'>
        <form onsubmit='return confirm('Are you sure you want to delete this blog post?\n You cannot undo this action!');'
            method='post' action='{{ route('binshopsblog.admin.destroy_post', $post->post_id) }}' class=''>
            @csrf
            <input name='_method' type='hidden' value='DELETE' />
            <button type='submit' class='btn btn-danger btn-sm' style='float:left; margin-left:24px;'>
                <i class='bi bi-trash-fill' aria-hidden='true'></i>
                Delete
            </button>
        </form>
    </div>
    </article>

    {{--    <div class='text-center'> --}}
    {{--        {{$posts->appends( [] )->links()}} --}}
    {{--    </div> --}}

@endsection
