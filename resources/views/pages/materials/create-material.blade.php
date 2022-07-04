<x-app-layout>
    <x-slot name="title">
        Create material
    </x-slot>
    <body>
    <div class="container">
        <h1 class="my-md-5 my-4">Добавить материал</h1>
        <div class="row">
            <div class="col-lg-5 col-md-8">
                <form method="POST" action="{{ route('createMaterial') }}">
                    @csrf
                    @method('POST')
                    <div class="form-floating mb-3">
                        <select class="select-type form-select" id="floatingSelectType" required>
                            <option disabled selected value="">Выберите тип</option>
                            @foreach(\App\Models\Type::all() as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        <input class="material-type-input" name="material-type" type="text" hidden value="">
                        <label for="floatingSelectType">Тип</label>
                        <div class="invalid-feedback">
                            Пожалуйста, выберите значение
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="select-category form-select" id="floatingSelectCategory" required>
                            <option disabled selected value="">Выберите категорию</option>
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <input class="material-category-input" name="material-category" type="text" hidden value="">
                        <label for="floatingSelectCategory">Категория</label>
                        <div class="invalid-feedback">
                            Пожалуйста, выберите значение
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="material-name" type="text" class="form-control" placeholder="Напишите название" id="floatingName" required>
                        <label for="floatingName">Название</label>
                        <div class="invalid-feedback">
                            Пожалуйста, заполните поле
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="material-author" type="text" class="form-control" placeholder="Напишите авторов" id="floatingAuthor" required>
                        <label for="floatingAuthor">Авторы</label>
                        <div class="invalid-feedback">
                            Пожалуйста, заполните поле
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                    <textarea name="material-description" class="form-control" placeholder="Напишите краткое описание" id="floatingDescription"
                              style="height: 100px"></textarea>
                        <label for="floatingDescription">Описание</label>
                        <div class="invalid-feedback">
                            Пожалуйста, заполните поле
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Добавить</button>
                </form>
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

<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
     tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Добавить ссылку</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Добавьте подпись"
                           id="floatingModalSignature">
                    <label for="floatingModalSignature">Подпись</label>
                    <div class="invalid-feedback">
                        Пожалуйста, заполните поле
                    </div>

                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Добавьте ссылку" id="floatingModalLink">
                    <label for="floatingModalLink">Ссылка</label>
                    <div class="invalid-feedback">
                        Пожалуйста, заполните поле
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Добавить</button>
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>


<script>
    $('.select-type').change(function () {
        $('.material-type-input').val($(this).val());
       console.log($('.material-type-input').val())
    });

    $('.select-category').change(function () {
        $('.material-category-input').val($(this).val());
        console.log($('.material-category-input').val())
    });
</script>
