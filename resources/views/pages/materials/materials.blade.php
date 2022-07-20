<x-app-layout>
    <x-slot name="title">
        Materials
    </x-slot>
    <body>
    <div class="container">
        <h1 class="my-md-5 my-4">Материалы</h1>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <h1 class="text-danger">{{ $error }}</h1>
            @endforeach
        @endif
        <a class="btn btn-primary mb-4" href="{{ route('createMaterial') }}" role="button">Добавить</a>
        <div class="row">
            <div class="col-md-8">
                <form method="POST" action="{{ route('findMaterials') }}">
                    @csrf
                    @method('POST')
                    <div class="input-group mb-3">
                        @isset($oldNeedle)
                            <input name='needle' type="text" class="form-control" placeholder="{{ $oldNeedle ?? '' }}"
                                   aria-label="Example text with button addon" aria-describedby="button-addon1">
                        @else
                            <input name='needle' type="text" class="form-control" placeholder=""
                                   aria-label="Example text with button addon" aria-describedby="button-addon1"
                                   required>
                        @endif
                        <button class="btn btn-primary" type="submit" id="button-addon1">Искать</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Название</th>
                    <th scope="col">Автор</th>
                    <th scope="col">Тип</th>
                    <th scope="col">Категория</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($materials as $material)
                    <tr class="{{ $material->id }}">
                        <td><a href="{{ route('viewMaterial', $material) }}">{{ $material->name }}</a></td>
                        <td>{{ $material->author }}</td>
                        <td>{{ $material->type->name }}</td>
                        <td>{{ $material->category->name }}</td>
                        <td class="text-nowrap text-end">
                            <a href="{{ route('editMaterialPage', $material) }}" class="text-decoration-none me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path
                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </a>
                            <a id="{{ $material->id }}" href="#exampleModalToggle" data-bs-toggle="modal"
                               class="delete-button text-decoration-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-trash" viewBox="0 0 16 16">
                                    <path
                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd"
                                          d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
                <h5 class="modal-title" id="exampleModalToggleLabel">Удаление материала</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    Вы уверены, что хотите удалить этот материал?
                </div>
            </div>
            <div class="modal-footer">
                <input class="material-id-post" type="hidden" value="">
                <button type="submit" class="delete-material-button btn btn-danger">Да</button>
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Нет</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('.delete-button').on('click', function () {
        let materialId = $(this).attr('id');
        $('.material-id-post').val(materialId);
        $('.delete-material-button').on('click', function () {
            let url = "{{ route('deleteMaterial', ':id') }}";
            url = url.replace(':id', materialId)

            $.post(url, {
                _token: '{{ csrf_token() }}',
            }).done(function (response) {
                console.log(response)
                if (response.msg == 'success') {
                    window.location.reload();
                }

                console.log(response.msg);
            });
        });

    });
</script>
