<x-app-layout>
    <x-slot name="title">
        {{ $material->id }}
    </x-slot>
    <body>
    <div class="container">
        <div class="d-flex flex-row justify-content-between">
            <h1 class="my-md-5 my-4">{{ $material->name }}</h1>
            <div>
                <button class="save-material-changes my-md-5 my-4 btn btn-success" type="button">Сохранить
                </button>
                <button class="save-material-cancel my-md-5 my-4 btn btn-danger" type="button">Отмена</button>
            </div>
        </div>
        <div class="material-data-edit row mb-3">
            <div class="col-lg-6 col-md-8">
                <div class="d-flex text-break">
                    <p class="col fw-bold mw-25 mw-sm-30 me-2">Название</p>
                    <input class="new-name" name="new-authors" value="{{ $material->name }}" required>
                </div>
                <div class="d-flex text-break">
                    <p class="col fw-bold mw-25 mw-sm-30 me-2">Авторы</p>
                    <input class="new-authors" name="new-authors" value="{{ $material->author }}" required>
                </div>
                <div class="d-flex text-break">
                    <p class="col fw-bold mw-25 mw-sm-30 me-2">Тип</p>
                    <select class="select-type form-select col mw-25 mw-sm-30" id="floatingSelectType" required>
                        <option disabled selected value="{{ $material->type->id }}">{{ $material->type->name }}</option>
                        @foreach(\App\Models\Type::all() as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    <input class="material-type-input" name="material-type" type="text" hidden
                           value="{{ $material->type->id }}">
                </div>
                <div class="d-flex text-break">
                    <p class="col fw-bold mw-25 mw-sm-30 me-2">Категория</p>
                    <select class="select-category form-select col mw-25 mw-sm-30" id="floatingSelectCategory" required>
                        <option disabled selected
                                value="{{ $material->category->id }}">{{ $material->category->name }}</option>
                        @foreach(\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <input class="material-category-input" name="material-category" type="text" hidden
                           value="{{ $material->category->id }}">
                </div>
                <div class="d-flex text-break">
                    <p class="col fw-bold mw-25 mw-sm-30 me-2">Описание</p>
                    <input class="new-description" name="new-description" value="{{ $material->description }}">
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
            crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    </body>
</x-app-layout>

<script>
    $('.save-material-cancel').on('click', function () {
        let url = "{{ route('viewMaterials') }}";
        window.location=url;
    });

    $('.select-type').change(function () {
        $('.material-type-input').val($(this).val());
        console.log($('.material-type-input').val())
    });

    $('.select-category').change(function () {
        $('.material-category-input').val($(this).val());
        console.log($('.material-category-input').val())
    });

    $('.save-material-changes').on('click', function () {

        if ($('.new-name').val() == '') {
            alert('Name field is required!');
        }
        let newName = $('.new-name').val();
        if ($('.new-authors').val() == '') {
            alert('Author field is required!');
        }
        let newAuthors = $('.new-authors').val();
        let newType = $('.material-type-input').val();
        let newCategory = $('.material-category-input').val();
        let materialId = {{ $material->id }};
        let newDescription = $('.new-description').val();
        let url = "{{ route('editMaterial', $material) }}";

        $.post(url, {
            _token: '{{ csrf_token() }}',
            materialId: materialId,
            newName: newName,
            newAuthors: newAuthors,
            newType: newType,
            newCategory: newCategory,
            newDescription: newDescription
        }).done(function (response) {
            console.log(response)
            if (response.msg == 'success') {
                window.location.reload();
            }

            console.log(response.msg);
        });
    });
</script>
