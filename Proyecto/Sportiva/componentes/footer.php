</main>

<footer class="footer mt-auto py-3" style="background-color: #204C73; color: white;">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-4 text-start">
                <a href="#">
                    <img src="../img/logo.png" alt="Logo" width="80" height="80">
                </a>
            </div>
            <div class="col-md-4 text-end">
                <p class="mb-0">&copy;2024 Sportiva™. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
    document.getElementById('userIcon').addEventListener('click', function() {
        var dropdown = document.getElementById('userDropdown');
        var iconSrc = this.src;

        if (iconSrc.includes('iconousuario2.png')) {
            if (dropdown.style.display === 'none' || dropdown.style.display === '') {
                dropdown.style.display = 'block';
            } else {
                dropdown.style.display = 'none';
            }
        } else {
            window.location.href = '../paginas/iniciosesion.php';
        }
    });

    document.addEventListener('click', function(event) {
        var dropdown = document.getElementById('userDropdown');
        var icon = document.getElementById('userIcon');
        if (!icon.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = 'none';
        }
    });
</script>

</body>
</html>