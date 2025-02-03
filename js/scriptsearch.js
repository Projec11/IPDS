document.addEventListener("DOMContentLoaded", function () {
    const searchIcon = document.getElementById("search-icon");
    const searchBox = document.getElementById("search-box");

    if (searchIcon && searchBox) {
        searchIcon.addEventListener("click", function () {
            searchBox.classList.toggle("hidden"); // Menambah/menghapus kelas "hidden"
            searchBox.classList.toggle("active"); // Menambah/menghapus kelas "active"
        });
    } else {
        console.error("Element with ID 'search-icon' or 'search-box' not found.");
    }
});

function searchWords() {
    const query = document.getElementById("searchBox").value.trim().toLowerCase();
    const searchResults = document.getElementById("searchResults");
    const mainContent = document.getElementById("mainContent");

    if (query === "") {
        searchResults.classList.add("hidden");
        mainContent.classList.remove("hidden");
        searchResults.innerHTML = "";
        return;
    }

    fetch(`search.php?query=${query}`)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                let resultHTML = `<h3>Hasil Pencarian untuk: <em>${query}</em></h3><ul>`;
                data.forEach(item => {
                    resultHTML += `
                        <li>
                            <a href="${item.link}" class="title-link"><strong>${item.title}</strong></a><br>
                            <ul>
                    `;
                    item.snippets.forEach(snippet => {
                        // Soroti kata pencarian dengan <strong>
                        resultHTML += `<li>${snippet}</li>`;  // Tampilkan cuplikan dengan kata pencarian yang disorot
                    });
                    resultHTML += `</ul></li>`;
                });
                resultHTML += `</ul>`;

                searchResults.innerHTML = resultHTML;
                searchResults.classList.remove("hidden");
                mainContent.classList.add("hidden");
            } else {
                searchResults.innerHTML = "<p>Tidak ditemukan hasil pencarian.</p>";
                searchResults.classList.remove("hidden");
                mainContent.classList.add("hidden");
            }
        })
        .catch(error => console.error("Gagal mengambil konten:", error));
}