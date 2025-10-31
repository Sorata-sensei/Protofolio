function loadPage(event, url) {
    // Mencegah link agar tidak berpindah halaman
    event.preventDefault();

    // Gunakan fetch untuk melakukan permintaan AJAX
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error("Error " + response.status);
            }
            return response.text();
        })
        .then(html => {
            const content = document.getElementById('content');
            content.innerHTML = html;

            // Cek kembali apakah ini halaman "home"
            if (content.getAttribute('data-page') === "home") {
                startTypingEffect();
            }
        })
        .catch(error => {
            document.getElementById('content').innerHTML = "Error loading page.";
            console.error(error);
        });
}