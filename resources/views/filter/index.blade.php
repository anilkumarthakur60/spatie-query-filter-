<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="row">
        <div class="col-sm-4">
            <p>Brands</p>
            @foreach ($brands as $brand)
                <label class="m-checkbox">
                    <input name="brand" type="checkbox" class="checkSingle" value="{{ $brand->id }}" @if (in_array($brand->id,
                    explode(',', request()->input('filter.brand'))))
                    checked
            @endif
            >
            {{ $brand->name }}
            </label>
            @endforeach

            <p>Categories</p>
            @foreach ($categories as $category)
                <label>
                    <input name="category" type="checkbox" class="checkSingle" value="{{ $category->id }}" @if (in_array($category->id,
                    explode(',', request()->input('filter.category'))))
                    checked
            @endif
            >
            {{ $category->name }}
            </label>
            @endforeach

            <p>Tags</p>
            @foreach ($tags as $tag)
                <label>
                    <input name="tag" type="checkbox" class="checkSingle" value="{{ $tag->id }}" @if (in_array($tag->id, explode(',',
                    request()->input('filter.tag'))))
                    checked
            @endif
            >
            {{ $tag->name }}
            </label>
            @endforeach

            <button type="button" id="filter">Filter</button>
<br>
<br>
<br>
             <label> <input type="checkbox" name="checkedAll" id="checkedAll"
                                                class="mr-2" />Check all </label>
        </div>
        <div class="col-sm-8">
            @foreach ($posts as $post)
                <span class="badge badge-danger">{{ $post->name }}</span>
            @endforeach
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script>
        function getIds(checkboxName) {
            let checkBoxes = document.getElementsByName(checkboxName);
            let ids = Array.prototype.slice.call(checkBoxes)
                .filter(ch => ch.checked == true)
                .map(ch => ch.value);
            return ids;
        }

        function filterResults() {
            let brandIds = getIds("brand");

            let categoryIds = getIds("category");
            let tagIds = getIds("tag");

            let href = 'posts?';

            if (brandIds.length) {
                href += 'filter[brand]=' + brandIds;
            }

            if (categoryIds.length) {
                href += '&filter[category]=' + categoryIds;
            }
            if (tagIds.length) {
                href += '&filter[tag]=' + tagIds;
            }

            document.location.href = href;
        }

        document.getElementById("filter").addEventListener("click", filterResults);
    </script>
    <script>



          $(document).ready(function() {
            $("#checkedAll").change(function() {
                if (this.checked) {
                    $(".checkSingle").each(function() {
                        this.checked = true;
                    })
                } else {
                    $(".checkSingle").each(function() {
                        this.checked = false;
                    })
                }
            });
            $(".checkSingle").click(function() {
                if ($(this).is(":checked")) {
                    var isAllChecked = 0;
                    $(".checkSingle").each(function() {
                        if (!this.checked)
                            isAllChecked = 1;
                    })
                    if (isAllChecked == 0) {
                        $("#checkedAll").prop("checked", true);
                    }
                } else {
                    $("#checkedAll").prop("checked", false);
                }
            });
        });
    </script>
</body>

</html>
