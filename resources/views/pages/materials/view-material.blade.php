<x-app-layout>
    <x-slot name="title">
        {{ $material->id }}
    </x-slot>
    <body>
    <div class="container">
        <div class="d-flex flex-row justify-content-between">
            <h1 class="my-md-5 my-4">{{ $material->name }}</h1>
            <div>
                <button class="edit-material my-md-5 my-4 btn btn-warning" type="button">Редактировать</button>
                <button class="delete-material my-md-5 my-4 btn btn-danger" type="button">Удалить</button>
                <button class="save-material-changes my-md-5 my-4 btn btn-success d-none" type="button">Сохранить
                </button>
                <button class="save-material-cancel my-md-5 my-4 btn btn-danger d-none" type="button">Отмена</button>
            </div>
        </div>
        <div class="material-data row mb-3">
            <div class="col-lg-6 col-md-8">
                <div class="d-flex text-break">
                    <p class="col fw-bold mw-25 mw-sm-30 me-2">Авторы</p>
                    <p class="col">{{ $material->author }}</p>
                </div>
                <div class="d-flex text-break">
                    <p class="col fw-bold mw-25 mw-sm-30 me-2">Тип</p>
                    <p class="col">{{ $material->type->name }}</p>
                </div>
                <div class="d-flex text-break">
                    <p class="col fw-bold mw-25 mw-sm-30 me-2">Категория</p>
                    <p class="col">{{ $material->category->name }}</p>
                </div>
                <div class="d-flex text-break">
                    <p class="col fw-bold mw-25 mw-sm-30 me-2">Описание</p>
                    <p class="col">{{ $material->description }}</p>
                </div>
            </div>
        </div>
        <div class="material-data-edit row mb-3 d-none">
            <div class="col-lg-6 col-md-8">
                <div class="d-flex text-break">
                    <p class="col fw-bold mw-25 mw-sm-30 me-2">Название</p>
                    <input class="new-name" name="new-authors" value="{{ $material->name }}">
                </div>
                <div class="d-flex text-break">
                    <p class="col fw-bold mw-25 mw-sm-30 me-2">Авторы</p>
                    <input class="new-authors" name="new-authors" value="{{ $material->author }}">
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
        <div class="row">
            <div class="col-md-6">
                <form>
                    <h3>Теги</h3>
                    <div class="input-group mb-3">
                        <select class="form-select" id="selectAddTag" aria-label="Добавьте автора">
                            <option selected>Тег1</option>
                            <option value="1">Тег2</option>
                            <option value="2">Тег3</option>
                            <option value="3">Тег4</option>
                        </select>
                        <button class="btn btn-primary" type="button">Добавить</button>
                    </div>
                </form>
                <ul class="list-group mb-4">
                    <li class="list-group-item list-group-item-action d-flex justify-content-between">
                        <a href="#" class="me-3">
                            Продуктивность
                        </a>
                        <a href="#" class="text-decoration-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-trash" viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd"
                                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </a></li>
                    <li class="list-group-item list-group-item-action d-flex justify-content-between">
                        <a href="#" class="me-3">
                            Личная эффективность
                        </a>
                        <a href="#" class="text-decoration-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-trash" viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd"
                                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-between mb-3">
                    <h3>Ссылки</h3>
                    <a class="btn btn-primary" data-bs-toggle="modal" href="#addLinkModal"
                       role="button">Добавить</a>
                </div>
                <ul class="list-group mb-4">
                    @if($material->data == null)
                        <h3>No links</h3>
                    @else
                        @foreach($material->links() as $link)
                            <li class="list-group-item list-group-item-action d-flex justify-content-between">
                                <a href="{{ $link['link-url'] }}" target="_blank" class="me-3">
                                    {{ $link['link-description'] ?? $link['link-url'] }}
                                </a>
                                <span class="text-nowrap">
                                    <a href="#" class="text-decoration-none me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
                                             class="bi bi-pencil" viewBox="0 0 16 16">
                                <path
                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                                    </a>
                                <a id="{{ $link['link-uuid'] }}" href="#removeLinkModal" data-bs-toggle="modal" class="delete-link text-decoration-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd"
                                              d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </a>
                                </span>
                            </li>
                        @endforeach
                    @endif

                </ul>
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

{{-- Добавление ссылок --}}
<div class="modal fade" id="addLinkModal" aria-hidden="true" aria-labelledby="addLinkModalToggleLabel"
     tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLinkModalToggleLabel">Добавить ссылку</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('addLink', $material) }}">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input name="link-description" type="text" class="form-control" placeholder="Добавьте подпись"
                               id="floatingModalSignature">
                        <label for="floatingModalSignature">Подпись</label>
                        <div class="invalid-feedback">
                            Пожалуйста, заполните поле
                        </div>

                    </div>
                    <div class="form-floating mb-3">
                        <input name="link-url" type="text" class="form-control" placeholder="Добавьте ссылку"
                               id="floatingModalLink" required>
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
            </form>
        </div>
    </div>
</div>
{{-- Удаление ссылок --}}
<div class="modal fade" id="removeLinkModal" aria-hidden="true" aria-labelledby="removeLinkModalToggleLabel"
     tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeLinkModalToggleLabel">Удаление ссылки</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    Вы уверены, что хотите удалить эту ссылку?
                </div>
            </div>
            <div class="modal-footer">
                <input class="link-uuid-post" type="hidden" value="">
                <button type="submit" class="delete-link-button btn btn-danger">Да</button>
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Нет</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.edit-material').on('click', function () {
        $(this).addClass('d-none');
        $('.material-data').addClass('d-none')

        $('.material-data-edit').removeClass('d-none')
        $('.save-material-changes').removeClass('d-none')
        $('.save-material-cancel').removeClass('d-none')
    });

    $('.save-material-cancel').on('click', function () {
        $(this).addClass('d-none');
        $('.material-data').removeClass('d-none')
        $('.edit-material').removeClass('d-none')

        $('.material-data-edit').addClass('d-none')
        $('.save-material-changes').addClass('d-none')
        $('.save-material-cancel').addClass('d-none')
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
        let newName = $('.new-name').val();
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

    $('.delete-link').on('click', function () {
       let linkUUID = $(this).attr('id');
       $('.link-uuid-post').val(linkUUID);


       $('.delete-link-button').on('click', function () {
           let url = "{{ route('deleteLink', $material) }}";
           $.post(url, {
               _token: '{{ csrf_token() }}',
               linkUUID: linkUUID
           }).done(function (response) {
               console.log(response)
               if (response.msg == 'success') {
                   window.location.reload();
               }
               console.log(response.msg);
           });
       });
    });

    $('.delete-material').on('click', function () {
        let url = "{{ route('deleteMaterial', $material) }}";
        $.post(url, {
            _token: '{{ csrf_token() }}',
        }).done(function (response) {
            console.log(response)
            if (response.msg == 'success') {
                window.location.href = "{{ route('viewMaterials') }}"
            }
            console.log(response.msg);
        });
    });
</script>