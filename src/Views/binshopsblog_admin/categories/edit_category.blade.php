@extends("binshopsblog_admin::layouts.admin_layout")
@section("content")


    <h5>Admin - Edit Category</h5>

    <form id="edit-category-form" method='post' action='{{route("binshopsblog.admin.categories.edit_category",$category->id)}}'  enctype="multipart/form-data" >

        @csrf

        <script>
            SHOULD_AUTO_GEN_SLUG = false;

            /* Generate the slug field, if it was not touched by the user (or if it was an empty string) */
            function populate_slug_field() {

//        alert("A");
                var cat_slug = document.getElementById('category_slug');

                if (cat_slug.value.length < 1) {
                    // if the slug field is empty, make sure it auto generates
                    SHOULD_AUTO_GEN_SLUG = true;
                }

                if (SHOULD_AUTO_GEN_SLUG) {
                    // the slug hasn't been manually changed (or it was set above), so we should generate the slug
                    // This is done in two stages - one to remove non words/spaces etc, the another to replace white space (and underscore) with a -
                    cat_slug.value =document.getElementById("category_category_name").value.toLowerCase()
                        .replace(/[^\w-_ ]+/g, '') // replace with nothing
                        .replace(/[_ ]+/g, '-') // replace _ and spaces with -
                        .substring(0,99); // limit str length

                }

            }
        </script>
        <div class="form-group">
            <label for="language_list">Select Language</label>
            <select id="language_list" name='lang_id' class='form-control'>
                @foreach($language_list as $language)
                    <option  value='{{$language->id}}' @if($language->id == $language_id)selected="selected" @endif>
                        {{$language->name}}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="category_category_name">Category Name</label>

            <input type="text"
                   class="form-control"
                   id="category_category_name"
                   oninput="populate_slug_field();"
                   required
                   aria-describedby="category_category_name_help"
                   name='category_name'
                   value="{{old("category_name",$category_translation->category_name)}}"
            >

            <small id="category_category_name_help" class="form-text text-muted">The name of the category</small>
        </div>


        <div class="form-group">
            <label for="category_slug">Category slug</label>
            <input
                maxlength='100'
                pattern="[a-zA-Z0-9-]+"
                type="text"
                required
                class="form-control"
                id="category_slug"
                oninput="SHOULD_AUTO_GEN_SLUG=false;"
                aria-describedby="category_slug_help"
                name='slug'
                value="{{old("slug",$category_translation->slug)}}"
            >

            <small id="category_slug_help" class="form-text text-muted">
                Letters, numbers, dash only. The slug
                i.e. {{route("binshopsblog.view_category",[app('request')->get('locale'),""])}}/<u><em>this_part</em></u>. This must be unique (two categories cant
                share the same slug).

            </small>
        </div>

        <div class="form-group">
            <label for="category_slug">Parent Category</label>
            <select name='parent_id' class='form-control'>
                <option @if($category->parent_id == 0) selected='selected' @endif value='0'>
                    Root
                </option>
                @foreach($categories_list as $category2)
                    @if($category->id != $category2->category_id)
                    <option @if($category->parent_id == $category2->category_id) selected='selected' @endif value='{{$category2->category_id}}'>
                        {{$category2->category_name}}
                    </option>
                    @endif
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <label for="category_description">Category Description (optional)</label>
            <textarea name='category_description'
                      class='form-control'
                      id='category_description'>{{old("category_description",$category_translation->category_description)}}</textarea>

        </div>
        <input id="selected_lang" name="selected_lang" type="number" value="-1" hidden>

        <script>
            if (document.getElementById("category_slug").value.length < 1) {
                SHOULD_AUTO_GEN_SLUG = true;
            } else {
                SHOULD_AUTO_GEN_SLUG = false; // there is already a value in #category_slug, so lets pretend it was changed already.
            }
        </script>

        <script>
            SHOULD_AUTO_GEN_SLUG = false;

            /* Generate the slug field, if it was not touched by the user (or if it was an empty string) */
            function populate_slug_field() {

//        alert("A");
                var cat_slug = document.getElementById('category_slug');

                if (cat_slug.value.length < 1) {
                    // if the slug field is empty, make sure it auto generates
                    SHOULD_AUTO_GEN_SLUG = true;
                }

                if (SHOULD_AUTO_GEN_SLUG) {
                    // the slug hasn't been manually changed (or it was set above), so we should generate the slug
                    // This is done in two stages - one to remove non words/spaces etc, the another to replace white space (and underscore) with a -
                    cat_slug.value =document.getElementById("category_name").value.toLowerCase()
                        .replace(/[^\w-_ ]+/g, '') // replace with nothing
                        .replace(/[_ ]+/g, '-') // replace _ and spaces with -
                        .substring(0,99); // limit str length

                }

            }

            if (document.getElementById("category_slug").value.length < 1) {
                SHOULD_AUTO_GEN_SLUG = true;
            } else {
                SHOULD_AUTO_GEN_SLUG = false; // there is already a value in #category_slug, so lets pretend it was changed already.
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



        </script>

        <script>
            //multi language
            var edit_toggle_url = '{{route("binshopsblog.admin.edit_category_toggle",$category->id)}}';
            var preLang = $('#language_list').val();
            $('#language_list').change(function (){
                $("#edit-category-form").attr("method", "post");
                $('#edit-category-form').attr('action', edit_toggle_url);
    
                $('#selected_lang').val($('#language_list').val());
                $('#language_list').val(preLang);
                console.log($('#language_list').val())
                $('#edit-category-form').trigger('submit');
            });
        </script>

        <input type='submit' class='btn btn-primary' value='Save Changes' >

    </form>

@endsection
