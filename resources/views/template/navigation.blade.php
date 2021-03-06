<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('main') }}">Test</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('viewMaterials') }}">Материалы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('viewTags') }}">Теги</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('viewCategories') }}">Категории</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('viewTypes') }}">Типы</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
