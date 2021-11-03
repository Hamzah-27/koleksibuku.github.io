<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="/css/style.css">

    <title><?= $title; ?></title>
</head>

<body>
    <div class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="pages">Koleksi Buku</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/pages/about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/pages/contact">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/buku">Buku</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <?= $this->renderSection('content'); ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.min.js"
        integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous">
    </script>

    <script>
    function previewImg() {
        const cover = document.querySelector('#cover');
        // const coverLabel = document.querySelector('.input-group-text');
        const imgPreview = document.querySelector('.img-preview');

        // coverLabel.textContent = cover.files[0].name;

        const $fileCover = new FileReader();
        $fileCover.readAsDataURL(cover.files[0]);

        $fileCover.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
    </script>
</body>

<!-- Footer -->
<footer class="page-footer font-small bg-light mt-3">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">
        <h6>© 2021 Copyright By : Hamzah Risvi</h6>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->

</html>