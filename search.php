<?php
header('Content-Type: application/json');

$searchQuery = isset($_GET['query']) ? strtolower(trim($_GET['query'])) : '';

$results = [];

if (!empty($searchQuery)) {
    // Daftar halaman yang akan dicari
    $pages = [
        //menu utama
        "IPDS" => "content/ipds.php",
        "Fungsi Lain" => "content/fungsi_lain.php",
        "Surat Tugas" => "content/surat_tugas.php",

        //menu ipds
        "Aneh" => "content/ipds/aneh.php",
        "DLS" => "content/ipds/dls.php",
        "IPD" => "content/ipds/ipd.php",
        "JRS" => "content/ipds/jrs.php",

        //menu fungsi lain
        "Nerwilis" => "content/fungsi_lain/nerwilis.php",
        "Produksi" => "content/fungsi_lain/produksi.php",
        "Sosial" => "content/fungsi_lain/sosial.php",
        "Distribusi" => "content/fungsi_lain/distribusi.php"
    ];

    foreach ($pages as $title => $filePath) {
        if (file_exists($filePath)) {
            $content = file_get_contents($filePath);
            
            // Gunakan strip_tags untuk menghapus HTML dan mendapatkan teks saja
            $textOnly = strip_tags($content);
            
            if (stripos($textOnly, $searchQuery) !== false) {
                // Cari bagian teks yang mengandung kata kunci
                preg_match_all("/.*?" . preg_quote($searchQuery, "/") . ".*?/i", $textOnly, $matches);
                
                // Ambil hanya beberapa hasil untuk ditampilkan
                $snippets = array_slice($matches[0], 0, 5);

                // Buat link judul agar langsung bisa diklik
                $pageLink = "index.php?module=" . strtolower(str_replace(" ", "_", $title));

                // Highlight kata pencarian dalam cuplikan
                $highlightedSnippets = array_map(function($snippet) use ($searchQuery) {
                    return preg_replace("/(" . preg_quote($searchQuery, "/") . ")/i", "<strong>$1</strong>", $snippet);
                }, $snippets);

                // Simpan hasil pencarian
                $results[] = [
                    "title" => $title,
                    "link" => $pageLink,  // Pastikan link ini benar
                    "snippets" => $highlightedSnippets
                ];
            }
        }
    }
}

// Kembalikan hasil dalam format JSON
echo json_encode($results);
?>